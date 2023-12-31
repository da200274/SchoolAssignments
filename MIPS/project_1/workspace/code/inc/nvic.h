#ifndef _NVIC_H_
#define _NVIC_H_

#include <stdint.h>

#include "utility.h"

typedef struct
{
	uint32_t volatile ISER[3];
	uint32_t volatile dummy0[29];
	uint32_t volatile ICER[3];
	uint32_t volatile dummy1[29];
	uint32_t volatile ISPR[3];
	uint32_t volatile dummy2[29];
	uint32_t volatile ICPR[3];
	uint32_t volatile dummy3[29];
	uint32_t volatile IABR[3];
	uint32_t volatile dummy4[61];
	uint32_t volatile IPR[21];
	uint32_t volatile dummy5[683];
	uint32_t volatile STIR;
} NVIC_RegisterMapType;

#define NVIC ((NVIC_RegisterMapType*) 0xE000E100)

#define NVIC_IRQ_SET(irq_number, priority) \
	SET_VALUE(NVIC->IPR[irq_number / 4], (irq_number % 4) * 8, (irq_number % 4) * 8 + 7, priority)

#endif
