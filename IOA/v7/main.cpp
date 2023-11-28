#include <iostream>
#include <cstdlib>
#include <fstream>

using namespace std;


void print_array(int* x) {
	for (int i = 0; i < 64; i++) {
		cout << x[i] << " ";
	}
	cout << endl;
}

int optimization_function(int* x, int* s) {
	int f1 = 33554432; //2^25
	int f2 = 33554432;

	int f_x = 0;
	for (int i = 0; i < 64; i++) {
		if (x[i] == 1) {
			f1 -= s[i];
		}
		else if (x[i] == 2) {
			f2 -= s[i];
		}
	}
	if (f1 < 0 || f2 < 0) {
		f_x = 67108864;
	}
	else {
		f_x = f1 + f2;
	}

	return f_x;
}

int hamming(int i_tot, int i) {
	int h_min = 0;
	int h_max = 15;

	double hamming = (h_min - h_max) * 1.0 * (i - 1);
	hamming = hamming / (i_tot - 1);
	hamming += h_max;

	return round(hamming);
}

int simulated_annealing(int start_func, int* x_original, int* values, int* s, std::ofstream& file) {

	int func_value = start_func;
	int* new_x = new int[64];
	int* x = new int[64];
	for (int i = 0; i < 64; i++) {//prepisivanje argumenta da bi moglo da se koristi lepo x
		x[i] = x_original[i];
	}

	double t0 = 64 * 1024 * 1024;
	int n_iter = 100000;
	int reannealing = 10;
	double alpha = 0.95;

	for (int k = 0; k < reannealing; k++) {
		for (int i = 0; i < n_iter; i++) {
			int hamm = hamming(n_iter, i + 1);


			for (int i = 0; i < 64; i++) {
				new_x[i] = x[i];
			}

			for (int i = 0; i < hamm; i++) { //generisanje narednih tacaka
				int random_index = rand() % 64;
				int random_value = rand() % 3;

				new_x[random_index] = random_value;
			}

			int new_func = optimization_function(new_x, s);
			if (new_func < func_value) {//delta E manje od nula
				func_value = new_func;
				for (int i = 0; i < 64; i++) {
					x[i] = new_x[i];
				}
			}
			else if (new_func > func_value) {//delta E pozitivno
				double p = exp(-(new_func - func_value) * 1.0 / t0); //0 < p < 1
				double random_value = rand() * 1.0 / INT_MAX;
				if (random_value < p) {
					func_value = new_func;
					for (int i = 0; i < 64; i++) {
						x[i] = new_x[i];
					}
				}
			}
			else {//delta E == 0
				double random_value = rand() * 1.0 / INT_MAX;
				if (random_value < 0.5) {
					func_value = new_func;
					for (int i = 0; i < 64; i++) {
						x[i] = new_x[i];
					}
				}
			}
			file << (i + 1) + (n_iter * k) << " " << func_value << std::endl;
			t0 *= alpha;
		}
	}
	cout << "Funkcija: " << func_value << endl;
	print_array(x);

	return 0;
}

int main() {
	const char* filename = "plotting.txt";

	std::ofstream outfile(filename);

	int s[] = { 173669, 275487, 1197613, 1549805, 502334, 217684, 1796841, 274708,
		631252, 148665, 150254, 4784408, 344759, 440109, 4198037, 329673,
		28602, 144173, 1461469, 187895, 369313, 959307, 1482335, 2772513,
		1313997, 254845, 486167, 2667146, 264004, 297223, 94694, 1757457,
		576203, 8577828, 498382, 8478177, 123575, 4062389, 3001419, 196884,
		617991, 421056, 3017627, 131936, 1152730, 2676649, 656678, 4519834,
		201919, 56080, 2142553, 326263, 8172117, 2304253, 4761871, 205387,
		6148422, 414559, 2893305, 2158562, 465972, 304078, 1841018, 1915571 };

	int values[] = { 0, 1, 2 };

	srand((unsigned)time(NULL));

	int* x = new int[64];

	for (int i = 0; i < 64; i++) {
		int random = rand() % 3;
		x[i] = values[random];
	}

	int start_func = optimization_function(x, s);

	for (int i = 0; i < 20; i++) {
		simulated_annealing(start_func, x, values, s, outfile);
	}

	return 0;
}