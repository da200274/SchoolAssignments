//
// Created by os on 8/22/22.
//

#ifndef PROJECT_BASE_V1_1_MEMORYALLOCATOR_HPP
#define PROJECT_BASE_V1_1_MEMORYALLOCATOR_HPP


#include "../lib/hw.h"

class MemoryAllocator {
private:
    static uint8* free;
    static uint64 blockSize;
    static uint32 iter;
public:
    static void* mem_allocate(size_t size);
    static int mem_deallocate(uint8* dealloc);
};


#endif //PROJECT_BASE_V1_1_MEMORYALLOCATOR_HPP
