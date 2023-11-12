//
// Created by os on 8/22/22.
//

#include "../h/MemoryAllocator.hpp"

uint8* MemoryAllocator::free = (uint8*)HEAP_START_ADDR;
uint64 MemoryAllocator::blockSize = MEM_BLOCK_SIZE;
uint32 MemoryAllocator::iter = 0;

void* MemoryAllocator::mem_allocate(size_t size) {
    if (size <= 0) return nullptr;
    if (iter++ == 0) {
        MemoryAllocator::free = (uint8*)HEAP_START_ADDR;
        MemoryAllocator::blockSize = MEM_BLOCK_SIZE;
        uint64 sizeAlloc = (uint64)((uint8*)HEAP_END_ADDR - (uint8*)HEAP_START_ADDR - sizeof(uint64) - sizeof(uint8*));
        uint64* initialize = (uint64*)free;
        *initialize = sizeAlloc;
        initialize++;
        *initialize = 0;
    }
    uint64* temp = (uint64*)free;
    uint64 zbir = size + sizeof(uint64) + sizeof(uint8*);
    if ((zbir) <= blockSize) size = blockSize;
    else {
        uint64 blockNum = (size + sizeof(uint64) + sizeof(uint8*)) / blockSize;
        size = (blockNum + 1) * blockSize;
    }
    uint8* current = free;
    uint8* previous = nullptr;
    uint8** next = nullptr;
    temp = nullptr;

    while (current) {
        temp = (uint64*)current;
        next = (uint8**)(current + sizeof(uint64)); //za testiranje
        if (*temp < size) {
            previous = current;
            next = (uint8**)(current + sizeof(uint64));
            current = *next; //dereferenciraj i dobijass adresu sledeceg elementa
        }
        else break;
    }
    if (!current) return nullptr;

    uint64 oldSize = *temp;
    uint8** oldNext = (uint8**)(++temp);
    if (*oldNext == 0 || oldSize - size >= blockSize) {
        temp += size;
    }
    else {
        temp = (uint64*)*oldNext; //ako smo istrosili originalni element za alokaciju
    }

    uint64* cur = (uint64*)current;
    *cur = size;
    cur++;

    if (previous) {
        uint8** tempPrev = (uint8**)(previous + sizeof(uint64));
        *tempPrev = current;
    }

    current += size;
    free = current;
    temp = (uint64*)current;

    *temp = oldSize - size;
    temp++;
    uint64** tempNext = (uint64**)temp;
    *tempNext = (uint64*)*oldNext;

    *cur = 0;//za kraj ova linija

    return (void*)(++cur);
}

int MemoryAllocator::mem_deallocate(uint8* dealloc) {
    if (!iter) return -1;

    uint8* current = free;
    uint8* previous = nullptr;
    uint8** next = nullptr;

    while (current) {
        previous = current;
        next = (uint8**)(current + sizeof(uint64));
        current = *next;
    }
    //previous pokazuje na poslednji element u listi
    uint8** previousNext = (uint8**)(previous + sizeof(uint64));
    uint8* deallocStart = (uint8*)(dealloc - sizeof(uint8*) - sizeof(uint64));
    *previousNext = deallocStart;


    current = free;
    while (current && iter < 0) {
        uint64* currentSize = (uint64*)current;
        uint8* linearFragment = (uint8*)(current + *currentSize);
        uint64* linearFragmentSize = (uint64*)(linearFragment);
        uint8** linearFragmentNext = (uint8**)(linearFragment + sizeof(uint64));
        if (current != free && (*linearFragmentNext != 0 || linearFragment == deallocStart)) {//radice se shrink
            uint8* traverse = free, * traversePrev = nullptr;
            uint8** traverseNext = nullptr;
            while (traverse) {
                if (traverse == linearFragment) break;
                traversePrev = traverse;
                traverseNext = (uint8**)(traverse + sizeof(uint64));
                traverse = *traverseNext;
            }
            //imamo dva cvora koje spajamo, imamo traversePrev kao prethodnik cvora koji spajamo
            uint64* currentSize = (uint64*)current;
            *currentSize += *linearFragmentSize;
            if (traversePrev) {
                traverseNext = (uint8**)(traversePrev + sizeof(uint64));
                *traverseNext = *linearFragmentNext;
            }
            else {//oslobadja se prvi elem u listi
                traverseNext = (uint8**)(traverse + sizeof(uint64));
                uint8* newFirst = *traverseNext;
                free = newFirst;
            }
        }
        previous = current;
        next = (uint8**)(current + sizeof(uint64));
        current = *next;
    }


    return 0;
}