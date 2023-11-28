PROGRAM = program
BUILD = build
DEBUG = 1

SOURCE_C = \
src/main.c \
src/handlers.c \
src/test.c

SOURCE_S = \
src/startup_code.s

OBJECTS_LIST = 
OBJECTS_LIST += $(addprefix $(BUILD)/, $(notdir $(SOURCE_S:.s=.o)))
OBJECTS_LIST += $(addprefix $(BUILD)/, $(notdir $(SOURCE_C:.c=.o)))
vpath %.s $(sort $(dir $(SOURCE_S)))
vpath %.c $(sort $(dir $(SOURCE_C)))

LINKER_SCRIPT = linker_script.ld

MCU = -mcpu=cortex-m3 -mthumb

AS = arm-none-eabi-gcc -c -x assembler
CC = arm-none-eabi-gcc -c
HX = arm-none-eabi-objcopy -O ihex
LD = arm-none-eabi-ld

FLAGS_INCLUDE = -Iinc

FLAGS_DEBUG = -g -gdwarf-2 -fdebug-prefix-map==../

FLAGS_AS = 
FLAGS_AS += $(MCU)
ifeq ($(DEBUG), 1)
FLAGS_AS += $(FLAGS_DEBUG)
endif

FLAGS_CC = 
FLAGS_CC += $(MCU)
FLAGS_CC += -MMD -MP
ifeq ($(DEBUG), 1)
FLAGS_CC += $(FLAGS_DEBUG)
endif
FLAGS_CC += $(FLAGS_INCLUDE)
FLAGS_CC += -mlong-calls

all : $(BUILD)/$(PROGRAM).hex $(BUILD)/$(PROGRAM).elf

$(BUILD)/$(PROGRAM).hex : $(BUILD)/$(PROGRAM).elf
	$(HX) $(<) $(@)
	
$(BUILD)/$(PROGRAM).elf : $(OBJECTS_LIST) makefile
	$(LD) -T $(LINKER_SCRIPT) -o $(@) $(OBJECTS_LIST)

$(BUILD)/%.o : %.s makefile | $(BUILD)
	$(AS) $(FLAGS_AS) -o $(@) $(<)
	
$(BUILD)/%.o : %.c makefile | $(BUILD)
	$(CC) $(FLAGS_CC) -o $(@) $(<)
	
$(BUILD) :
	mkdir $(@)
	
clean :
	rm -rf $(BUILD)

-include $(wildcard $(BUILD)*.d)