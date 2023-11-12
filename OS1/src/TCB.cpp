//
// Created by os on 8/27/22.
//

#include "../h/TCB.hpp"
#include "../h/Riscv.hpp"
#include "../test/printing.hpp"

TCB* TCB::running = nullptr;
uint64 TCB::id = 0;

TCB* TCB::createThread(Body body, void* arg, uint32 value){
    return new TCB(body, arg, value);
}

void TCB::yield(){
    Riscv::pushRegisters();

    TCB::dispatch();

    Riscv::popRegisters();
}

void TCB::dispatch(){
    TCB* old = running;

    if(!old->isFinished() && !old->isBlocked()){
        Scheduler::put(old);
    }
    running = Scheduler::get();

    TCB::contextSwitch(&old->context, &running->context);
}

TCB::TCB(TCB::Body b, void *arg, uint32 value) {

    body = b;
    arguments = arg;
    if(body != nullptr){
        stack = new uint64[DEFAULT_STACK_SIZE];
        context.ra = (uint64) &threadWrapper;
    }
    else{
        stack = nullptr;
        context.ra = 0;
    }
    if(stack != nullptr){
        context.sp = (uint64) &stack[STACK_SIZE];
    }
    else context.sp = 0;

    finished = false;
    identification = id++;
    semaphore = Sem::createSemaphore(0);

    if (body != nullptr && value == 1) {
        Scheduler::put(this);
    }
}

void TCB::dispatchThreadExit() {
    TCB* old = running;
    old->setFinished(true);
    running = Scheduler::get();

    if(old != running) {
        TCB::contextSwitch(&old->context, &running->context);
    }
}

bool TCB::isBlocked() const {
    return blocked;
}

void TCB::setBlocked(bool blocked) {
    TCB::blocked = blocked;
}

void TCB::threadWrapper()
{
    Riscv::popSppSpie();
    running->body(running->arguments);
    running->setFinished(true);
    running->semaphore->close();
    TCB::yield();
}

uint64 TCB::getIdentification() const {
    return identification;
}

void TCB::join() {
    semaphore->wait();
}

TCB *TCB::get() {
    Elem* temp = head;
    head = head->next;
    TCB* t = temp->thread;
    MemoryAllocator::mem_deallocate((uint8*)temp);
    return t;
}

void TCB::put(TCB* other) {
    Elem* elem = (Elem*) MemoryAllocator::mem_allocate(sizeof(Elem));
    elem->thread = other;
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
