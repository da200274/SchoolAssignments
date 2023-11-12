#include "../h/MemoryAllocator.hpp"
#include "../h/syscall_cpp.hpp"
void* operator new(size_t n){
    return MemoryAllocator::mem_allocate(n);
}

void operator delete(void* ptr){
    MemoryAllocator::mem_deallocate((uint8*)ptr);
}

void* operator new[](size_t n){
    return MemoryAllocator::mem_allocate(n);
}

void operator delete[](void* ptr){
    MemoryAllocator::mem_deallocate((uint8*)ptr);
}

Thread::Thread(void (*body)(void *), void *arg) {
    uint32 res = thread_create(&myHandle, body, arg);
    if(res){
        printString("Thread constructor error");
    }
}

Thread::~Thread() {

}

int Thread::start() {
    uint64 res = thread_start(myHandle);
    if(!res) return 0;
    else return -1;
}

void Thread::dispatch() {
    thread_dispatch();//ili treba yield?
}

Thread::Thread() {
    thread_create_no_scheduler(&myHandle, cppWrapper, this);
}

void Thread::cppWrapper(void *arg) {
    Thread* thread = (Thread*)arg;
    thread->run();
}

void Thread::join() {
    thread_join(myHandle); //myHandle je tipa TCB*
}

Semaphore::Semaphore(unsigned int init) {
    uint32 res = sem_open(&myHandle, init);
    if(res){
        printString("Semaphore constructor error");
    }
}

Semaphore::~Semaphore() {
    sem_close(myHandle);
}

int Semaphore::wait() {
    uint32 res = sem_wait(myHandle);
    if(res){
        int result = -1;
        return result;
    }
    return 0;
}

int Semaphore::signal() {
    uint32 res = sem_signal(myHandle);
    if(res){
        int result = -1;
        return result;
    }
    return 0;
}

char Console::getc() {
    char c = __getc();
    return c;
}

void Console::putc(char c) {
    __putc(c);
}
