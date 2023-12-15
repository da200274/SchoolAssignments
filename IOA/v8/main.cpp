#include <iostream>
#include <cstdlib>
#include <fstream>
#include <vector>
#include <algorithm>

using namespace std;

void print_array(int* x) {
	for (int i = 0; i < 64; i++) {
		cout << x[i] << " ";
	}
	cout << endl;
}

int optimization_function(int* x, int* s) {
	int f1 = 33554432;
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

void condition_check(int** generation, int n_pop, int gen, int* s, std::ofstream& file) {
	for (int i = 0; i < n_pop; i++) {
		int func_value = optimization_function(generation[i], s);
		file << (n_pop * gen) + (i + 1) << " " << func_value << std::endl;
	}
}

void selection(int** new_gen, int** generation, int n_pop, int* s, int n_new_gen) {
	std::vector<pair<int, int>> niz;
	for (int i = 0; i < n_pop; i++) {
		int opt_func = optimization_function(generation[i], s);
		niz.push_back(make_pair(opt_func, i));
	}

	std::sort(niz.begin(), niz.end());

	for (int i = 0; i < n_new_gen; i++) {
		int* x = new int[64];
		for (int j = 0; j < 64; j++) {
			x[j] = generation[niz[i].second][j];
		}

		new_gen[i] = x;
	}
}


void crossover(int** new_gen, int** generation, int n_pop, int n_new_gen, int* s) {
	for (int i = 0; i < n_pop; i += 2) {
		double p = rand() * 1.0 / INT_MAX;
		if (p < 0.8) {
			int crossover = 28;
			/*while (crossover == 0 || crossover == 63) {
				crossover = rand() % 64;
			}*/
			int parent1 = rand() % n_new_gen;
			int parent2 = rand() % n_new_gen;

			int* x = new int[64];
			int* y = new int[64];
			for (int v = 0; v < 64; v++) {
				if (v < crossover) {
					x[v] = new_gen[parent1][v];
					y[v] = new_gen[parent2][v];
				}
				else {
					x[v] = new_gen[parent2][v];
					y[v] = new_gen[parent1][v];
				}
			}
			generation[i] = x;
			generation[i + 1] = y;
		}
		else {
			i -= 2;
		}
	}
}

void mutation(int** generation, int values[3], int n_pop) {
	double mutation = 0.1;
	for (int i = 0; i < n_pop; i++) {
		double p = rand() * 1.0 / INT_MAX;
		if (p < mutation) {
			int rand_indeks = rand() % 64;
			int rand_value = rand() % 3;
			generation[i][rand_indeks] = values[rand_value];
		}
	}
}

void genetic_algorithm(int* s, std::ofstream& file) {
	int n_pop = 20000;
	int n_new_gen = 2500;
	int** generation = new int* [n_pop];
	int** new_gen = new int* [n_new_gen];
	int sol[64] = { 1, 1, 2, 1, 0, 2, 0, 0, 1, 1, 1, 2, 1, 2, 2, 2, 1, 0, 2, 0, 0, 0, 0, 0, 2, 1, 1, 0, 0, 1, 2, 1, 1,
					1, 2, 1, 1, 2, 1, 1, 1, 0, 0, 2, 2, 0, 2, 0, 0, 1, 0, 1, 2, 1, 0, 2, 0, 2, 1, 0, 2, 1, 2, 2 };

	int values[] = { 0, 1, 2 };


	for (int i = 0; i < n_pop; i++) {
		int* x = new int[64];
		for (int i = 0; i < 64; i++) {
			int random = rand() % 3;
			x[i] = values[random];
		}
		generation[i] = x;
	}

	for (int gen = 0; gen < 50; gen++) {

		condition_check(generation, n_pop, gen, s, file);

		selection(new_gen, generation, n_pop, s, n_new_gen);

		crossover(new_gen, generation, n_pop, n_new_gen, s);

		mutation(generation, values, n_pop);
	}

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


	srand((unsigned)time(NULL));

	for (int i = 0; i < 20; i++) {
		genetic_algorithm(s, outfile);
	}

	return 0;
}