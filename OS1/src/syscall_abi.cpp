//
// Created by os on 8/23/22.
//

#include "../h/syscall_abi.hpp"

uint64 syscall_abi::code = 0;

void* syscall_abi::syscall(uint64 arg0, void *arg1, void *arg2, void *arg3, void *arg4, void *arg5, void *arg6, uint64* arg7) {
    uint64 res;
    __asm__ volatile("ecall");
    __asm__ volatile ("sd a0, %0" : "=m"(res));//arg7 se ne koristi
    arg7 = &res;
    return arg7;
}

void* syscall_abi::abiAllocate(size_t size) {
    code = 0x01;
    uint64* res = (uint64*)syscall(code, &size);
    return (void*)*res;
}

uint64 syscall_abi::abiDeallocate(void *ptr) {
    code = 0x02;
    uint64* res = (uint64*)syscall(code, &ptr);
    return *res;
}

uint64 syscall_abi::abiThreadCreate(thread_t *handle, void (*startRoutine)(void *), void *arg) {
    code = 0x11;
    uint64* res = (uint64*)syscall(code, &startRoutine, &arg);
    *handle = (TCB*)*res;
    return 0;
}

uint64 syscall_abi::abiThreadExit(){
    code = 0x12;
    uint64* res = (uint64*)syscall(code);
    return *res;
}

void syscall_abi::abiDispatch() {
    code = 0x13;
    syscall(code);
}

uint64 syscall_abi::abiSemOpen(sem_t *handle, uint64 init) {
    code = 0x21;
    uint64* res = (uint64*)syscall(code, &init);
    *handle = (Sem*)*res;
    return 0;
}

uint64 syscall_abi::abiSemClose(sem_t handle) {
    code = 0x22;
    syscall(code, &handle);
    return 0;
}

uint64 syscall_abi::abiSemWait(sem_t id) {
    code = 0x23;
    syscall(code, &id);
    return 0;
}

uint64 syscall_abi::abiSemSignal(sem_t id) {
    code = 0x24;
    syscall(code, &id);
    return 0;
}

char syscall_abi::abiGetc() {
    code = 0x41;
    char* res = (char*)syscall(code);
    return *res;
}

void syscall_abi::abiPutc(char c) {
    code = 0x42;
    syscall(code, &c);
}

uint64 syscall_abi::abiThreadStart(thread_t handle) {
    code = 0x50;
    uint64* res = (uint64*)syscall(code, &handle);
    return *res;
}

void syscall_abi::abiUserMode() {
    code = 0x51;
    syscall(code);
}

uint32 syscall_abi::abiThreadCreateNoScheduler(thread_t *handle, void (*startRoutine)(void *), void *arg) {
    code = 0x52;
    uint64* res = (uint64*)syscall(code, &startRoutine, &arg);
    *handle = (TCB*)*res;
    return 0;
}

void syscall_abi::abiJoin(thread_t handle) {
    code = 0x53;
    syscall(code, &handle);
}


