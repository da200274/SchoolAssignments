//
// Created by os on 9/5/22.
//

#include "../h/Sem.hpp"
#include "../test/printing.hpp"


uint32 Sem::wait() {
    if(!isOpen()){
        //printString("Puklo u wait\n");
        return 1;
    }

    TCB* oldRunning = TCB::running;
    if(--value < 0){
        putBlocked(oldRunning);
        oldRunning->setBlocked(true);
        TCB::dispatch();
    }
    return 0;
}

uint32 Sem::signal() {
    if(!isOpen()){
        //printString("Puklo u signal\n");
        return 1;
    }
    if(++value <= 0){
        TCB* toPut = getBlocked();
        toPut->setBlocked(false);
        Scheduler::put(toPut);
    }
    return 0;
}

void Sem::putBlocked(TCB *oldRunning) {
    Elem* elem = (Elem*) MemoryAllocator::mem_allocate(sizeof(Elem));
    elem->thread = oldRunning;
    elem->next = nullptr;
    elem->thread->setBlocked(true);
    if (!head) {
        head = elem;
    }
    else {
        Elem* prev = nullptr;
        for (Elem* temp = head; temp != nullptr; temp = temp->next) {
            prev = temp;
        }
        prev->next = elem;
    }
}

TCB* Sem::getBlocked() {
    Elem* temp = head;
    TCB* t = temp->thread;
    head = head->next;
    MemoryAllocator::mem_deallocate((uint8*)temp);
    return t;

}

Sem::Sem(uint64 initialize) {
    value = initialize;
    open = true;
}

Sem *Sem::createSemaphore(uint64 init) {
    return new Sem(init);
}

void Sem::setOpen(bool open) {
    Sem::open = open;
}

bool Sem::isOpen() const {
    return open;
}

uint32 Sem::close() {
    if(!isOpen()) return 1;
    setOpen(false);

    for (Elem* temp = head; temp != nullptr; temp = temp->next) {
        temp->thread->setBlocked(false);
        Scheduler::put(temp->thread);
    }

    return 0;
}

