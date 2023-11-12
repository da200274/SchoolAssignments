#include <iostream>
#include <vector>
#include <algorithm>
#include <cmath>

using namespace std;

float Lnorm(pair<float, float> a, pair<float, float> b) {
	float x = a.first - b.first;
	float y = a.second - b.second;

	return sqrt(x * x + y * y);
}

void min_dist(vector<pair<float, float>> coordinates, int n) {

	float matrix[12][12];

	for (int i = 0; i < 12; i++) {
		for (int j = 0; j < 12; j++) {
			matrix[i][j] = Lnorm(coordinates[i], coordinates[j]);
		}
	}

	int* p = new int[n];

	for (int i = 0; i < n; i++) {
		p[i] = i + 1;
	}

	float min_dist = INT_MAX;
	int* result = new int[n];

	do {
		float cur_dist = 0;
		for (int i = 0; i < n - 1; i++) {
			cur_dist += matrix[p[i] - 1][p[i + 1] - 1];
		}
		if (cur_dist < min_dist) {
			min_dist = cur_dist;
			for (int i = 0; i < n; i++) {
				result[i] = p[i];
			}
		}

	} while (next_permutation(p, p + n));

	cout << "Minimum distance: " << min_dist << endl;
	cout << "Path: ";
	for (int i = 0; i < n; i++) {
		cout << result[i] << " ";
	}
	cout << endl;

	delete[] p;
	delete[] result;
}

int main() {

	vector<pair<float, float>> coordinates = {
		{2.7, 33.1}, {2.7, 56.8}, {9.1, 40.3}, {9.1, 52.8}, {15.1, 49.6}, {15.3, 37.8},
		{21.5, 45.8}, {22.9, 32.7}, {33.4, 60.5}, {28.4, 31.7}, {34.7, 26.4}, {45.7, 25.1}
	};


	min_dist(coordinates, 8);
	min_dist(coordinates, 12);

	

	return 0;
}