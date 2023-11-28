#include "stk.h"
#include "scb.h"
#include "test.h"
#include "nvic.h"

void systick_init(){
	STK->LOAD = 4000000-1;
	STK->VAL = 0;
	STK->CTRL |= STK_CTRL_CLCSOURCE | STK_CTRL_ENABLE | STK_CTRL_TICKINT;
}

int main(){
	test4();

	//SCB->AIRCR |= (0x0FA << 16);
	NVIC_IRQ_SET(0, 0x03);
	NVIC_IRQ_SET(1, 0x01);
	NVIC_IRQ_SET(2, 0x02);

	NVIC->ISER[0] |= 0x07;

	NVIC->ISPR[0] |= 0x07;

	systick_init();

	while(1);

	return 0;
}
