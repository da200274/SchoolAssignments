//
// Created by os on 8/22/22.
//
#include "../h/TCB.hpp"
#include "../h/Riscv.hpp"
#include "../h/syscall_cpp.hpp"
#include "../test/printing.hpp"

extern void userMain(void* arg);

int main()
{
    Riscv::w_stvec((uint64) &Riscv::interruptWrapper);
    thread_t mainThread, userThread;
    thread_create(&mainThread, nullptr, nullptr);
    TCB::running = mainThread;
    thread_create(&userThread, &userMain, nullptr);
    Riscv::userMode();
    Riscv::maskSet_sstatus(Riscv::SSTATUS_SIE);

//    for(int i = 0; i < 5; i++){
//        printString("Zasto putc radi a getc ne radi?\n");
//    }

    while(!userThread->isFinished()){
        thread_dispatch();
    }

    return 0;
}
