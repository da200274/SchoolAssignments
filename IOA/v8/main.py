import matplotlib.pyplot as plt
import numpy as np

# File path
file_path = 'plotting.txt'

# Initialize variables to store data for plotting
x_values = []
y_values = []

x_values.append(0)
y_values.append(67108864)

x_second = []
for i in range(1000000):
    x_second.append(i + 1)
y_second = [0] * 1000000

# Counters for lines read and lines between plots
lines_read = 0
lines_between_plots = 1000000  # Set to 1 million
lines_to_add = 100000  # Set to 100k

# Open the file in read mode
with open(file_path, 'r') as file:
    for line in file:
        # Split the line into two integers
        values = line.split()

        # Convert the values to integers
        num1 = int(values[0])
        num2 = int(values[1])

        # Process the integers as needed
        # For example, accumulate values for plotting
        x_values.append(num1)
        y_values.append(num2)

        # Update counters
        lines_read += 1

        # Check if it's time to plot
        if lines_read % lines_between_plots == 0:
            # Plot the graph with log-log scaling
            color = np.random.rand(3, )

            min_values = [y_values[0]]
            for value in y_values[1:]:
                min_values.append(min(value, min_values[-1]))
            print(min_values[-1])
            # Sum two arrays
            for i in range(1000000):
                y_second[i] += min_values[i]

            plt.loglog(x_values, min_values, color=color)

            # Clear the data for the next batch
            x_values.clear()
            y_values.clear()

            x_values.append(0)
            y_values.append(67108864)


plt.title(f'Cumulative graph')
plt.xlabel('Number of iterations')
plt.ylabel('Cost function')
plt.show()

M = 20
for i in range(1000000):
    y_second[i] = y_second[i] / M

plt.loglog(x_second, y_second, linewidth=0.4)
plt.title(f'Mean value graph')
plt.xlabel('Number of iterations')
plt.ylabel('AVERAGE Cost function')
plt.show()
