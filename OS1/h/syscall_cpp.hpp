//
// Created by os on 9/12/22.
//

#ifndef PROJECT_BASE_V1_1_SYSCALL_CPP_HPP
#define PROJECT_BASE_V1_1_SYSCALL_CPP_HPP

#include "syscall_c.hpp"
#include "../test/printing.hpp"

void* operator new(size_t n);
void operator delete(void* ptr);
void* operator new[](size_t n);
void operator delete[](void* ptr);

class Thread{
public:
    Thread(void (*body)(void*), void* arg);
    virtual ~Thread();

    int start();

    static void dispatch();
    static void cppWrapper(void* arg);

    void join();

protected:
    Thread();
    virtual void run(){}

private:
    thread_t myHandle;
};

class Semaphore{
public:
    Semaphore(unsigned init = 1);
    virtual ~Semaphore();

    int wait();
    int signal();

private:
    sem_t myHandle;
};

class Console{
public:
    static char getc();
    static void putc(char c);
};

#endif //PROJECT_BASE_V1_1_SYSCALL_CPP_HPP
