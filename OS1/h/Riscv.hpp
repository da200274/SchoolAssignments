//
// Created by os on 8/22/22.
//

#ifndef PROJECT_BASE_V1_1_RISCV_HPP
#define PROJECT_BASE_V1_1_RISCV_HPP

#include "../h/MemoryAllocator.hpp"
#include "../lib/console.h"
#include "syscall_abi.hpp"

class Riscv {
public:
    //pop sstatus.spp and sstatus.spie bits
    static void popSppSpie();

    //push x0,..,x31 registers on stack
    static void pushRegisters();

    //pop x31,..,x0 registers from stack
    static void popRegisters();

    //read register scause
    static uint64 r_scause();

    //write register scause
    static void w_scause(uint64 scause);

    //read register sepc
    static uint64 r_sepc();

    //write register sepc
    static void w_sepc(uint64 sepc);

    //read register stvec
    static uint64 r_stvec();

    //write register stvec
    static void w_stvec(uint64 stvec);

    //BitMaskSip
    static uint64 SIP_SSIE;
    static uint64 SIP_STIE;
    static uint64 SIP_SEIE;

    //mask set register sip
    static void maskSet_sip(uint64 mask);

    //mask clear register sip
    static void maskClr_sip(uint64 mask);

    //read register sip
    static uint64 r_sip();

    //write register sip
    static void w_sip(uint64 sip);

    static uint64 SSTATUS_SIE;
    static uint64 SSTATUS_SPIE;
    static uint64 SSTATUS_SPP;

    //mask set register sstatus
    static void maskSet_sstatus(uint64 mask);

    //mask clear register sstatus
    static void maskClr_sstatus(uint64 mask);

    //read register sstatus
    static uint64 r_sstatus();

    //write register sstatus
    static void w_sstatus(uint64 sstatus);

    static void interrupt();

    //read register sscratch
    static uint64 r_sscratch();

    static void interruptWrapper();

    static uint64 ret1();

    static uint64 ret0();

    static void userMode();
};

inline uint64 Riscv::r_scause() {
    uint64 volatile scause; //u promenljivu scause upisuje
    __asm__ volatile ("csrr %[scause], scause" : [scause] "=r"(scause));
    return scause;
}

inline void Riscv::w_scause(uint64 scause) {
    __asm__ volatile ("csrw scause, %[scause]" : : [scause] "r"(scause));
}

inline uint64 Riscv::r_sepc() {
    uint64 volatile sepc; //u promenljivu scause upisuje
    __asm__ volatile ("csrr %[sepc], sepc" : [sepc] "=r"(sepc));
    return sepc;
}

inline void Riscv::w_sepc(uint64 sepc) {
    __asm__ volatile ("csrw sepc, %[sepc]" : : [sepc] "r"(sepc));
}

inline uint64 Riscv::r_stvec() {
    uint64 volatile stvec; //u promenljivu scause upisuje
    __asm__ volatile ("csrr %[stvec], stvec" : [stvec] "=r"(stvec));
    return stvec;
}

inline void Riscv::w_stvec(uint64 stvec) {
    __asm__ volatile ("csrw stvec, %[stvec]" : : [stvec] "r"(stvec));
}

inline void Riscv::maskSet_sip(uint64 mask) {
    __asm__ volatile ("csrs sip, %[mask]" : : [mask] "r"(mask));
}

inline void Riscv::maskClr_sip(uint64 mask) {
    __asm__ volatile ("csrc sip, %[mask]" : : [mask] "r"(mask));
}

inline uint64 Riscv::r_sip() {
    uint64 volatile sip; //u promenljivu scause upisuje
    __asm__ volatile ("csrr %[sip], sip" : [sip] "=r"(sip));
    return sip;
}

inline void Riscv::w_sip(uint64 sip) {
    __asm__ volatile ("csrw sip, %[sip]" : : [sip] "r"(sip));
}

inline void Riscv::maskSet_sstatus(uint64 mask) {
    __asm__ volatile ("csrs sstatus, %[mask]" : : [mask] "r"(mask));
}

inline void Riscv::maskClr_sstatus(uint64 mask) {
    __asm__ volatile ("csrc sstatus, %[mask]" : : [mask] "r"(mask));
}

inline uint64 Riscv::r_sstatus() {
    uint64 volatile sstatus; //u promenljivu scause upisuje
    __asm__ volatile ("csrr %[sstatus], sstatus" : [sstatus] "=r"(sstatus));
    return sstatus;
}

inline void Riscv::w_sstatus(uint64 sstatus) {
    __asm__ volatile ("csrw sstatus, %[sstatus]" : : [sstatus] "r"(sstatus));
}

inline uint64 Riscv::r_sscratch() {
    uint64 volatile sscratch; //u promenljivu scause upisuje
    __asm__ volatile ("csrr %[sscratch], sscratch" : [sscratch] "=r"(sscratch));
    return sscratch;
}

inline uint64 Riscv::ret1() {
    return 1;
}

inline uint64 Riscv::ret0() {
    return 0;
}


#endif //PROJECT_BASE_V1_1_RISCV_HPP
