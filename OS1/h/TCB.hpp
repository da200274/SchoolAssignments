//
// Created by os on 8/27/22.
//

#ifndef PROJECT_BASE_V1_1_TCB_HPP
#define PROJECT_BASE_V1_1_TCB_HPP

#include "../lib/hw.h"
#include "Scheduler.hpp"
#include "MemoryAllocator.hpp"
#include "Sem.hpp"

class Sem;
class TCB{
public:

    struct Elem {
        TCB* thread;
        struct Elem* next;
    };

    bool isFinished() const {return finished; }
    void setFinished(bool value) {finished = value; }

    using Body = void(*)(void*);

    static TCB* createThread(Body body, void* args = nullptr, uint32 value = 5);

    static void yield();

    static TCB* running;

    static uint64 id;

    ~TCB()// {MemoryAllocator::mem_deallocate((uint8*)stack);}
    {delete[] stack;}

    TCB(Body b, void* arg, uint32 value);

private:

    struct Context{
        uint64 ra;
        uint64 sp;
    };

    Body body;
    void* arguments;
    uint64* stack;
    Context context;
    bool finished;
    uint64 identification;
    bool blocked = false;
    Sem* semaphore;

    Elem* head = nullptr;

public:
    uint64 getIdentification() const;

    static void dispatch();

    bool isBlocked() const;

    void setBlocked(bool blocked);

    void join();

    TCB* get();

    void put(TCB* other);

    Elem* getHead(){return head;}

private:
    friend class Riscv;

    static void threadWrapper();

    static void contextSwitch(Context *oldContext, Context *runningContext);

    static void dispatchThreadExit();

    static uint64 constexpr STACK_SIZE = 1024;

};


#endif //PROJECT_BASE_V1_1_TCB_HPP
