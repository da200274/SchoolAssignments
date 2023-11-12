#include <iostream>

using namespace std;


int matrix[10][10] = {
	{0, 374, 350, 223, 108, 178, 252, 285, 240, 356},
	{374, 0, 27, 166, 433, 199, 135, 95, 136, 17},
	{350, 27, 0, 41, 52, 821, 180, 201, 131, 247},
	{223, 166, 41, 0, 430, 47, 52, 84, 40, 155},
	{108, 433, 52, 430, 0, 453, 478, 344, 389, 423},
	{178, 199, 821, 47, 453, 0, 91, 37, 64, 181},
	{252, 135, 180, 52, 478, 91, 0, 25, 83, 117},
	{285, 95, 201, 84, 344, 37, 25, 0, 51, 42},
	{240, 136, 131, 40, 389, 64, 83, 51, 0, 118},
	{356, 17, 247, 155, 423, 181, 117, 42, 118, 0}
};

int calculate_cost(int* t, int n, int k) {
	int cost = 0;
	int* repeat = new int[n];
	for (int i = 0; i < n; i++) repeat[i] = 0;
	for (int i = 0; i < 2 * (k + 1); i += 2) {
		cost += matrix[t[i]][t[i + 1]];
		repeat[t[i]]++;
		repeat[t[i + 1]]++;
	}
	for (int i = 0; i < n; i++) {
		if (repeat[i] >= 4) {
			cost += 250 * (repeat[i] - 3);
		}
	}
	return cost;
}


void sequence_to_spanning_tree(int* p, int len, int* t) {
	int q = 0;
	int n = len + 2;
	int* v = new int[n];

	for (int i = 0; i < n; i++) {
		v[i] = 0;
	}

	for (int i = 0; i < len; i++) {
		v[p[i]] += 1;
	}

	for (int i = 0; i < len; i++) {
		for (int j = 0; j < n; j++) {
			if (v[j] == 0) {
				v[j] = -1;
				t[q++] = j;
				t[q++] = p[i];
				v[p[i]]--;
				break;
			}
		}
	}

	int j = 0;
	for (int i = 0; i < n; i++) {
		if (v[i] == 0 && j == 0) {
			t[q++] = i;
			j++;
		}
		else if (v[i] == 0 && j == 1) {
			t[q++] = i;
			break;
		}
	}

	delete[] v;
}


void variations_with_repetition(int n, int k) {
	int q;
	int* p = new int[k];
	int cost = INT_MAX;

	int* best_sequence = new int[2 * (k + 1)];

	int* t = new int[2 * (k + 1)];
	for (int i = 0; i < k; i++) {
		p[i] = 0;
	}

	do {
		sequence_to_spanning_tree(p, k, t);
		int new_cost = calculate_cost(t, n, k);

		if (new_cost < cost) {
			cost = new_cost;
			for (int i = 0; i < 2 * (k + 1); i++) {
				best_sequence[i] = t[i];
			}
		}

		q = k - 1;
		while (q >= 0) {
			p[q]++;
			if (p[q] == n) {
				p[q] = 0;
				q--;
			}
			else break;
		}
	} while (q >= 0);



	for (int i = 0; i < 2 * (k + 1); i++) {
		char letter = (char)(65 + best_sequence[i]);
		cout << letter << " ";
		if ((i + 1) % 2 == 0 && i < 2 * k) {
			cout << " -  ";
		}
	}
	cout << endl << "Min cost is: " << cost << endl;

	delete[] t;
	delete[] p;
}


int main() {

	variations_with_repetition(10, 8);

	return 0;
}