//
// Created by os on 8/24/22.
//

#ifndef PROJECT_BASE_V1_1_SYSCALL_C_HPP
#define PROJECT_BASE_V1_1_SYSCALL_C_HPP

#include "../h/syscall_abi.hpp"
#include "../lib/console.h"

class TCB;
typedef TCB* thread_t;

class Sem;
typedef Sem* sem_t;
void* mem_alloc(size_t size);

uint64 mem_free(void* ptr);

uint32 thread_create(thread_t* handle, void(*startRoutine)(void*), void* arg);

uint32 thread_exit();

void thread_dispatch();

uint32 sem_open(sem_t* handle, unsigned init);

uint32 sem_close(sem_t handle);

uint32 sem_wait(sem_t id);

uint32 sem_signal(sem_t id);

uint64 thread_start(thread_t handle);

char getc();

void putc(char c);

uint32 thread_create_no_scheduler(thread_t* handle, void(*startRoutine)(void*), void* arg);

void thread_join(thread_t handle);

#endif //PROJECT_BASE_V1_1_SYSCALL_C_HPP
