#include "test.h"

void nmi_handler(){

}

void hard_fault_handler(){

}

void mem_manage_fault_handler(){

}

void bus_fault_handler(){

}

void usage_fault_handler(){

}

void sv_call_handler(){

}

void pend_sv_handler(){

}

void systick_handler(){
	test6();
}

void irq0_handler(){
	test7_irq0();
}

void irq1_handler(){
	test7_irq1();
}

void irq2_handler(){
	test7_irq2();
}
