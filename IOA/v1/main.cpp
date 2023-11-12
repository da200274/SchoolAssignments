#include <iostream>

using namespace std;

int main() {
	long long iter1 = 0;
	double x = 0;
	double y = 0;
	double z = 0;
	double q = 0;
	for (int i = 1; i < 708; i++) {
		for (int j = 1; j < 708 && i + j < 711; j++) {
			for (int k = 1; k < 708 && i + j + k < 711; k++) {
				for (int l = 1; l < 708; l++) {
					iter1++;
					if (i + j + k + l == 711 && i * j * k * l == 711000000) {
						x = i * 1.0 / 100;
						y = j * 1.0 / 100;
						z = k * 1.0 / 100;
						q = l * 1.0 / 100;
						cout << "prva cena:" << x << ", druga cena:" << y << ", treca cena:" << z << ", cetvrta cena:" << q << endl;
						break;
					}
				}
				if (x) break;
			}
			if (x) break;
		}
		if (x) break;
	}
	cout << "iter1 = " << iter1 << endl;

	x = 0;
	y = 0;
	z = 0;
	long long iter2 = 0;
	int rest = 0;
	for (int i = 1; i < 708; i++) {
		for (int j = 1; j < 708 && i + j < 711; j++) {
			for (int k = 1; k < 708 && i + j + k < 711; k++) {
				iter2++;
				rest = 711 - i - j - k;
				if (i * j * k * rest == 711000000) {
					x = i * 1.0 / 100;
					y = j * 1.0 / 100;
					z = k * 1.0 / 100;
					q = rest * 1.0 / 100;
					cout << "prva cena:" << x << ", druga cena:" << y << ", treca cena:" << z << ", cetvrta cena:" << q << endl;
					break;
				}
			}
			if (x) break;
		}if (x) break;
	}
	cout << "iter2 = " << iter2 << endl;
	cout << "odnos iter1/iter2 = " << iter1 / iter2;
	return 0;
}