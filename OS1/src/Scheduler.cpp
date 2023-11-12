//
// Created by os on 8/27/22.
//

#include "../h/Scheduler.hpp"
#include "../test/printing.hpp"

Scheduler::Elem* Scheduler::head = nullptr;

TCB* Scheduler::get()
{
    Elem* temp = head;
    head = head->next;
    TCB* t = temp->thread;
    MemoryAllocator::mem_deallocate((uint8*)temp);
    return t;
}

void Scheduler::put(TCB* toPut)
{
    Elem* elem = (Elem*) MemoryAllocator::mem_allocate(sizeof(Elem));
    elem->thread = toPut;
    elem->next = nullptr;
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


