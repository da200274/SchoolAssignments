//
// Created by os on 8/23/22.
//

#ifndef PROJECT_BASE_V1_1_SYSCALL_ABI_HPP
#define PROJECT_BASE_V1_1_SYSCALL_ABI_HPP

#include "../lib/hw.h"

class TCB;
typedef TCB* thread_t;

class Sem;
typedef Sem* sem_t;

class syscall_abi {
public:

    static uint64 code;

    static void* syscall(uint64 arg0, void* arg1 = nullptr, void* arg2 = nullptr, void* arg3 = nullptr
            , void* arg4 = nullptr, void* arg5 = nullptr, void* arg6 = nullptr, uint64* arg7 = nullptr);

    static void* abiAllocate(size_t size);

    static uint64 abiDeallocate(void* ptr);

    static uint64 abiThreadCreate(thread_t* handle, void(*startRoutine)(void*), void *arg);

    static void abiDispatch();

    static uint64 abiThreadExit();

    static uint64 abiSemOpen(sem_t* handle, uint64 init);

    static uint64 abiSemClose(sem_t handle);

    static uint64 abiSemWait(sem_t id);

    static uint64 abiSemSignal(sem_t id);

    static uint64 abiThreadStart(thread_t handle);

    static char abiGetc();

    static void abiPutc(char c);

    static void abiUserMode();

    static uint32 abiThreadCreateNoScheduler(thread_t* handle, void(*startRoutine)(void*), void *arg);

    static void abiJoin(thread_t handle);
};


#endif //PROJECT_BASE_V1_1_SYSCALL_ABI_HPP
