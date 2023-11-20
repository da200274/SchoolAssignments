from math import sqrt


class Heuristic:
    def get_evaluation(self, state):
        pass


class ExampleHeuristic(Heuristic):
    def get_evaluation(self, state):
        return 0


class HammingHeuristics(Heuristic):
    def get_evaluation(self, state):
        result = 0
        for i in range(len(state)):
            if state[i] != (i + 1):
                result = result + 1
        return result


def get_indices(index, value):
    return index // value, index % value


class ManhattanHeuristics(Heuristic):
    def get_evaluation(self, state):
        result = 0
        value = int(sqrt(len(state)))
        for i in range(len(state)):
            index_i, index_j = get_indices(i, value)
            index_value = state[i]
            index_value = index_value - 1
            if index_value >= 0:
                final_i, final_j = get_indices(index_value, value)
                result = result + abs(index_i - final_i) + abs(index_j - final_j)
        return result
