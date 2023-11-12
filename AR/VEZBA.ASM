! inicijalizacija simulacije
dc x.1, x.9996
dc x.0, x.9998
onkp false, x.1, x.1
onkp false, x.1, x.1
onkp true, x.1, x.1
ondma x.1, x.1
ondma x.1, x.1
ondma x.1, x.1
ondma x.1, x.1
kpreg 1.1, r0, x.1
kpreg 1.1, r1, x.2
kpreg 1.1, r2, x.3
kpreg 1.1, r3, x.4
kpreg 1.1, r4, x.5
kpreg 1.1, r5, x.6
kpreg 1.1, r6, x.7
kpreg 1.1, r7, x.8
kpreg 2.1, r0, x.9
kpreg 2.1, r1, x.a
kpreg 2.1, r2, x.b
kpreg 2.1, r3, x.c
kpreg 2.1, r4, x.d
kpreg 2.1, r5, x.e
kpreg 2.1, r6, x.f
kpreg 2.1, r7, x.10
reg pc, x.4000
reg ivtp, x.4000
reg sp, x.9000
! kraj inicijalizacije

! pocetak programa
org x.4000
ldimm x.300, r0
mvrir r0, ivtp

!inicijalizacija ivtp
ldimm x.2000, r0 ! ulaz 0
stmem x.300, r0
ldimm x.1500, r0 ! ulaz 1
stmem x.301, r0
ldimm x.2500, r0 ! ulaz 2
stmem x.302, r0
ldimm x.500, r0 ! ulaz 3
stmem x.303, r0
ldimm x.1000, r0 ! ulaz 4
stmem x.304, r0
ldimm x.3000, r0 ! ulaz 5
stmem x.305, r0

! inicijalizacija brojaca i pokazivaca
ldimm x.9, r0
stmem x.4000, r0 ! cntA
stmem x.4001, r0 ! cntB
ldimm x.5000, r0
stmem x.4002, r0 ! ptrA
ldimm x.6000, r0
stmem x.4003, r0 ! ptrB
clr r0
stmem x.4004, r0 ! semA
stmem x.4005, r0 ! semB

! pokretanje periferija
ldimm x.3, r0
stmem x.f102, r0 ! ulaz u ivtp za kp1.1
ldimm x.f, r0 ! 1111
stmem x.f100, r0 ! control registar kp1.1
ldimm x.1, r0
stmem x.f202, r0 ! ulaz u ivtp za kp2.1
ldimm x.f, r0 ! 1111
stmem x.f200, r0 ! control registar kp2.1

wait1: 	ldmem x.4004, r0
	ldimm x.1, r1
	and r1, r1, r0
	beql wait1

wait2:	ldmem x.4005, r2
	ldimm x.1, r3
	and r3, r3, r2
	beql wait2

! obrada
ldimm x.5000, r0
push r0 ! push ptrA
ldimm x.6000, r0
push r0 ! push ptrB
ldimm x.8, r0
push r0 ! push length
jsr sumAll
pop r1
pop r2
pop r3

! smesti rezultat
ldimm x.9999, r1
stri [r1], r0

! inicijalizacija dma1.4
clr r0
stmem x.4000, r0 ! semDMA
ldimm x.8, r0
stmem x.f0c4, r0 ! count
ldimm x.6000, r0
stmem x.f0c5, r0 ! source
ldimm x.6100, r0
stmem x.f0c6, r0 ! destination
ldimm x.5, r0
stmem x.f0c2, r0 ! entry
ldimm x.be, r0
stmem x.f0c0, r0 ! control

! kopiranje niza B
waitD4: 	ldmem x.4000, r0
	ldimm x.1, r1
	and r1, r1, r0
	beql waitD4

! inicijalizacija dma1.1
clr r0
stmem x.4000, r0 ! semDMA
ldimm x.8, r0
stmem x.f004, r0 ! count
ldimm x.5000, r0
stmem x.f005, r0 ! source
ldimm x.0, r0
stmem x.f002, r0 ! entry
ldimm x.0e, r0 ! 0000 1110
stmem x.f000, r0 ! control

waitD1:	ldmem x.4000, r0
	ldimm x.1, r1
	and r1, r1, r0
	beql waitD1

! inicijalizacija dma1.2
clr r0
stmem x.4000, r0 ! semDMA
ldimm x.1, r0
stmem x.f044, r0 ! count
ldimm x.9999, r0
stmem x.f045, r0 ! source
ldimm x.2, r0
stmem x.f042, r0 ! entry
ldimm x.8e, r0 ! 1000 1110
stmem x.f040, r0 ! control

waitD2:	ldmem x.4000, r0
	ldimm x.1, r1
	and r1, r1, r0
	beql waitD2

halt

! potprogram
sumAll:	pop r7 ! pc
	pop r6 ! length
	pop r5 ! ptrB
	pop r4 ! ptrA
	push r4
	push r5
	push r6
	push r7

	push r8 ! za citanje jednog elementa

	clr r0
loop:	ldrid [r4]x.0, r8 ! r8 <= mem[ptrA]
	add r0, r0, r8 ! r0 += r8
	inc r4 ! ptrA++
	ldrid [r5]x.0, r8 ! r8 <= mem[ptrB]
	add r0, r0, r8 ! r0 += r8
	inc r5 ! ptrB++
	
	dec r6 ! length--
	bneq loop ! vrti se dok ne saberes sve

	pop r8
	rts


! prekidna rutina kp1.1
org x.500
push r0
push r1
ldmem x.4000, r0
dec r0
stmem x.4000, r0 ! cntA--

bneq ret1 ! ako nije dosao do poslednjeg, preskoci
clr r0
stmem x.f100, r0 ! ako je dosao do poslednjeg, iskljuci kontroler
ldimm x.1, r0
stmem x.4004, r0 ! postavi semafor

ret1:	ldmem x.f103, r0
	ldmem x.4002, r1
	stri[r1], r0 ! mem[ptrA++] = data
	inc r1
	stmem x.4002, r1
	pop r1
	pop r0
	rti

! prekidna rutina kp2.1
org x.1500
push r0
push r1
ldmem x.4001, r0
dec r0
stmem x.4001, r0 ! cntB--

bneq ret2 ! ako nije dosao do poslednjeg, prekoci
clr r0
stmem x.f200, r0 ! ako je dosao do poslednjeg, iskljuci kontroler
ldimm x.1, r0
stmem x.4005, r0 ! postavi semafor

ret2:	ldmem x.f203, r0
	ldmem x.4003, r1
	stri[r1], r0 ! mem[ptrB++] = data
	inc r1
	stmem x.4003, r1
	pop r1
	pop r0
	rti

! prekidna rutina dma1.4
org x.3000
push r0
clr r0
stmem x.f0c0, r0 ! zaustavi dma
ldimm x.1, r0
stmem x.4000, r0 ! postavi semafor
pop r0
rti

! prekidna rutina dma1.1
org x.2000
push r0
clr r0
stmem x.f000, r0 ! zaustavi dma
ldimm x.1, r0
stmem x.4000, r0 ! postavi semafor
pop r0
rti

! prekidna rutina dma1.2
org x.2500
push r0
clr r0
stmem x.f040, r0 ! zaustavi dma
ldimm x.1, r0
stmem x.4000, r0 ! postavi semafor
pop r0
rti