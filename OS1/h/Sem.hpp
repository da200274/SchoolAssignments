//
// Created by os on 9/5/22.
//

#ifndef PROJECT_BASE_V1_1_SEM_HPP
#define PROJECT_BASE_V1_1_SEM_HPP
#include "../lib/hw.h"
#include "../h/TCB.hpp"

class TCB;
class Sem {
public:
    struct Elem {
        TCB* thread;
        struct Elem* next;
    };

    static Sem* createSemaphore(uint64 init);

    uint32 wait();

    void setOpen(bool open);

    uint32 signal();

    bool isOpen() const;

    uint32 close();

private:
    Sem(uint64 initialize);

    void putBlocked(TCB* oldRunning);

    TCB* getBlocked();

    int value;

    Elem* head = nullptr;

    bool open = false;
};
//one metode ne mogu biti static jer semaphore nije singleton

#endif //PROJECT_BASE_V1_1_SEM_HPP
