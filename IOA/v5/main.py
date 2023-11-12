import matplotlib.pyplot as plt
import numpy as np
from scipy.optimize import minimize


def calculate_xk(wk, wk_5, xin):
    return (wk * xin) + wk_5


def sigmoid(x_a):
    return 1 / (1 + np.exp(-x_a))


def train(w_array, x_array):
    y_output = []
    for x in x_array:
        a = []
        for i in range(5):
            x_k = calculate_xk(w_array[i], w_array[i + 5], x)
            a.append(sigmoid(x_k))

        y_training = w_array[15]

        for i in range(5):
            y_training += w_array[i + 10] * a[i]
        y_output.append(y_training)
    return y_output


def optimization(w_array, x_array, y_training):
    y_output = train(w_array, x_array)
    result = 0
    for i in range(51):
        result += (y_output[i] - y_training[i]) ** 2
    return result / 51


data_file = "data.txt"

with open(data_file, 'r') as file:
    lines = file.readlines()

x1 = []
y1 = []

# ucitavanje iz fajla
for line in lines:
    x, y = map(float, line.split())
    x1.append(x)
    y1.append(y)

# generisanje granica postojao je upper and lower bound ali su imali iste vrednosti kao ovi

min_value = -30
max_value = 30
bounds = [(min_value, max_value) for _ in range(16)]

f_min = 0.01
y2 = []

# generisanje vrednosti pocetnih za w
global_w0 = []
flag = False

for k in range(10):
    w0 = np.random.uniform(min_value, max_value, 16)

    result = minimize(optimization, w0, args=(x1, y1), method='nelder-mead', bounds=bounds)

    for i in range(len(result.x)):
        w0[i] = result.x[i]

    new_f = optimization(w0, x1, y1)
    print(new_f)

    if new_f < f_min:
        flag = True
        f_min = new_f
        global_w0 = []
        for i in range(len(w0)):
            global_w0.append(w0[i])

if flag == False:
    global_w0 = [-5.03105148, 18.91564772, -16.28486054, -28.64272138, -30., 8.50919025, 1.98750479, 0.95708303,
                 -1.80815094, -29.79325599, -19.88329011, -7.28217742, 16.3466727, -29.80710696, 4.70267166, 28.90774574]


# print("First set of w: ")
# print(global_w0)
# print(optimization(global_w0, x1, y1))

result = minimize(optimization, global_w0, args=(x1, y1), method='nelder-mead', bounds=bounds)

for i in range(len(result.x)):
    global_w0[i] = result.x[i]

new_f = optimization(global_w0, x1, y1)

print("set of w: ")
print(global_w0)
print(new_f)

y2 = train(global_w0, x1)

plt.plot(x1, y1, label="y_out")

plt.plot(x1, y2, label="y_training")

plt.xlabel('x - axis')
plt.ylabel('y - axis')
plt.title('Two lines on same graph!')

plt.legend()

plt.show()
