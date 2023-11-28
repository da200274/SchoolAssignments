_main_stack_pointer_value = 0x20002800;

MEMORY
{
	FLASH(rx) : ORIGIN = 0x08000000 , LENGTH = 32K
	SRAM(rwx) : ORIGIN = 0x20000000, LENGTH = 10K
}

SECTIONS
{
	.vector_table :
	{
		*(.vector_table)
	} > FLASH
	
	.text :
	{
		*(.text)
	} > FLASH
	
	.rodata :
	{
		*(.rodata)
	} > FLASH
	
	.data :
	{
		_vma_start = .;
		*(.data)
		_vma_end = .;
	} > SRAM AT > FLASH
	_lma_start = LOADADDR(.data);
	
	.bss :
	{
		*(.bss)
	} > SRAM
}