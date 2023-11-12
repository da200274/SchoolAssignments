//
// Created by os on 8/22/22.
//

#include "../h/Riscv.hpp"
#include "../h/TCB.hpp"
#include "../h/Sem.hpp"

uint64 Riscv::SIP_SSIE = 0x2;
uint64 Riscv::SIP_STIE = 0x20;
uint64 Riscv::SIP_SEIE = 0x200;

uint64 Riscv::SSTATUS_SIE = 0x2;
uint64 Riscv::SSTATUS_SPIE = 0x20;
uint64 Riscv::SSTATUS_SPP = 0x100;

void Riscv::popSppSpie()
{
    __asm__ volatile ("csrw sepc, ra");
    __asm__ volatile ("sret");
}

void Riscv::userMode() {
    syscall_abi::abiUserMode();
}

void Riscv::interrupt() {
    uint64 arg0, arg1, arg2, arg3, arg4, arg5, arg6, arg7;

    uint64 volatile scause = Riscv::r_scause();
    uint64 volatile sp = r_sscratch();
    uint64 volatile sepc = Riscv::r_sepc();

    __asm__ volatile("sd a0, %0" : "=m" (arg0));
    __asm__ volatile("sd a1, %0" : "=m" (arg1));
    __asm__ volatile("sd a2, %0" : "=m" (arg2));
    __asm__ volatile("sd a3, %0" : "=m" (arg3));
    __asm__ volatile("sd a4, %0" : "=m" (arg4));
    __asm__ volatile("sd a5, %0" : "=m" (arg5));
    __asm__ volatile("sd a6, %0" : "=m" (arg6));
    __asm__ volatile("sd a7, %0" : "=m" (arg7));


    if(scause == 0x8000000000000001){//najprivilegovaniji rezim
        maskClr_sip(SIP_SSIE);
    }
    else if(scause == 0x8000000000000009){//spoljasnji hardverski prekid
        console_handler();
    }
    else if(scause == 0x0000000000000008 || scause == 0x0000000000000009){//ecall
        uint64 volatile sstatus = Riscv::r_sstatus();
        Riscv::w_sepc(sepc + 4);
        if(arg0 == 0x01){
            MemoryAllocator::mem_allocate(*(uint64*)arg1);
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));
        }
        else if(arg0 == 0x02){
            MemoryAllocator::mem_deallocate(*(uint8**)arg1);
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));
        }
        else if(arg0 == 0x11){
            TCB::createThread(*(TCB::Body*)arg1, (void*)(*(uint64*)arg2), 1);
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));
        }
        else if(arg0 == 0x12){
            sstatus = Riscv::r_sstatus();
            sepc = Riscv::r_sepc();

            TCB::dispatchThreadExit();

            w_sstatus(sstatus);
            w_sepc(sepc);
        }
        else if(arg0 == 0x13){
            sstatus = Riscv::r_sstatus();
            sepc = Riscv::r_sepc();

            TCB::dispatch();

            w_sstatus(sstatus);
            w_sepc(sepc);
        }
        else if(arg0 == 0x21){
            Sem::createSemaphore(*(uint64*)arg1);
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));
        }
        else if(arg0 == 0x22){
            sstatus = Riscv::r_sstatus();
            sepc = Riscv::r_sepc();

            Sem* semaphore= (Sem*)(*(uint64*)arg1);
            semaphore->close();
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));

            w_sstatus(sstatus);
            w_sepc(sepc);
        }
        else if(arg0 == 0x23){
            sstatus = Riscv::r_sstatus();
            sepc = Riscv::r_sepc();

            Sem* semaphore= (Sem*)(*(uint64*)arg1);
            semaphore->wait();
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));

            w_sstatus(sstatus);
            w_sepc(sepc);
        }
        else if(arg0 == 0x24){
            sstatus = Riscv::r_sstatus();
            sepc = Riscv::r_sepc();

            Sem* semaphore= (Sem*)(*(uint64*)arg1);
            semaphore->signal();
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));

            w_sstatus(sstatus);
            w_sepc(sepc);
        }
        else if(arg0 == 0x41){
            __getc();
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));
        }
        else if(arg0 == 0x42){
            __putc((char)*((uint64*)arg1));
        }
        else if(arg0 == 0x50){
            Scheduler::put((TCB*)*((uint64*)arg1));
            ret0();
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));
        }
        else if(arg0 == 0x51){
            uint64 status = r_sstatus();
            uint64 mask = ~0x100;
            status &= mask;
            w_sstatus(status);
        }
        else if(arg0 == 0x52){
            TCB::createThread(*(TCB::Body*)arg1, (void*)(*(uint64*)arg2), 0);
            __asm__ volatile("sd a0, 80(%0)" : : "r"(sp));
        }
        else if(arg0 == 0x53){
            sstatus = Riscv::r_sstatus();
            sepc = Riscv::r_sepc();

            TCB* other = (TCB*)(*(uint64*)arg1);
            other->join();

            w_sstatus(sstatus);
            w_sepc(sepc); //cuvanje sstatus registra i sepc jer se menja kontekst
        }
        Riscv::w_sstatus(sstatus);
    }
    else{
        //neregularnost instrukcija
//        printInteger(Riscv::r_scause());
//        printString("\n");
//        printInteger(Riscv::r_sepc());
//        printString("\n");

    }

}
