//
// Created by os on 8/24/22.
//

#include "../h/syscall_c.hpp"
void* mem_alloc(size_t size) {
    uint8* alloc = (uint8*)syscall_abi::abiAllocate(size);
    return alloc;
}

uint64 mem_free(void *ptr) {
    uint64 res = syscall_abi::abiDeallocate(ptr);
    return res;
}

uint32 thread_create(thread_t* handle, void(*startRoutine)(void*), void* arg){
    uint32 res = syscall_abi::abiThreadCreate(handle, startRoutine, arg);
    return res;
}

uint32 thread_exit(){
    uint32 res = syscall_abi::abiThreadExit();
    return res;
}

void thread_dispatch(){
    syscall_abi::abiDispatch();
}

uint32 sem_open(sem_t* handle, unsigned init){
    uint32 res = syscall_abi::abiSemOpen(handle, init);
    return res;
}

uint32 sem_close(sem_t handle){
    uint32 res = syscall_abi::abiSemClose(handle);
    return res;
}

uint32 sem_wait(sem_t id){
    uint32 res = syscall_abi::abiSemWait(id);
    return res;
}

uint32 sem_signal(sem_t id){
    uint32 res = syscall_abi::abiSemSignal(id);
    return res;
}

uint64 thread_start(thread_t handle){
    uint64 res = syscall_abi::abiThreadStart(handle);
    return res;
}

char getc(){
    char c = syscall_abi::abiGetc();
    return c;
}

void putc(char c){
    syscall_abi::abiPutc(c);
}

uint32 thread_create_no_scheduler(thread_t* handle, void(*startRoutine)(void*), void* arg){
    uint32 res = syscall_abi::abiThreadCreateNoScheduler(handle, startRoutine, arg);
    return res;
}

void thread_join(thread_t handle){
    syscall_abi::abiJoin(handle);
}



