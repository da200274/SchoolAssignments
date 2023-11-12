//
// Created by os on 8/27/22.
//

#ifndef PROJECT_BASE_V1_1_SCHEDULER_HPP
#define PROJECT_BASE_V1_1_SCHEDULER_HPP

#include "MemoryAllocator.hpp"

class TCB;
class Scheduler {
public:
    struct Elem {
        TCB* thread;
        struct Elem* next;
    };

    static TCB* get();

    static void put(TCB* toPut);

private:

    static Elem* head;
};

#endif //PROJECT_BASE_V1_1_SCHEDULER_HPP
