import random
import time
from collections import deque

import config


class Algorithm:
    def __init__(self, heuristic=None):
        self.heuristic = heuristic
        self.nodes_evaluated = 0
        self.nodes_generated = 0

    def get_legal_actions(self, state):
        self.nodes_evaluated += 1
        max_index = len(state)
        zero_tile_ind = state.index(0)
        legal_actions = []
        if 0 <= (up_ind := (zero_tile_ind - config.N)) < max_index:
            legal_actions.append(up_ind)
        if 0 <= (right_ind := (zero_tile_ind + 1)) < max_index and right_ind % config.N:
            legal_actions.append(right_ind)
        if 0 <= (down_ind := (zero_tile_ind + config.N)) < max_index:
            legal_actions.append(down_ind)
        if 0 <= (left_ind := (zero_tile_ind - 1)) < max_index and (left_ind + 1) % config.N:
            legal_actions.append(left_ind)
        return legal_actions

    def apply_action(self, state, action):
        self.nodes_generated += 1
        copy_state = list(state)
        zero_tile_ind = state.index(0)
        copy_state[action], copy_state[zero_tile_ind] = copy_state[zero_tile_ind], copy_state[action]
        return tuple(copy_state)

    def get_steps(self, initial_state, goal_state):
        pass

    def get_solution_steps(self, initial_state, goal_state):
        begin_time = time.time()
        solution_actions = self.get_steps(initial_state, goal_state)
        print(f'Execution time in seconds: {(time.time() - begin_time):.2f} | '
              f'Nodes generated: {self.nodes_generated} | '
              f'Nodes evaluated: {self.nodes_evaluated}')
        return solution_actions


class ExampleAlgorithm(Algorithm):
    def get_steps(self, initial_state, goal_state):
        state = initial_state
        solution_actions = []
        while state != goal_state:
            legal_actions = self.get_legal_actions(state)
            action = legal_actions[random.randint(0, len(legal_actions) - 1)]
            solution_actions.append(action)
            state = self.apply_action(state, action)
        return solution_actions


class BFS(Algorithm):
    def get_steps(self, initial_state, goal_state):
        queue = deque([(initial_state, [])])
        visited = set()
        while queue:
            current_state, actions = queue.popleft()

            if current_state in visited:
                continue
            visited.add(current_state)

            if current_state == goal_state:
                return actions

            legal_actions = self.get_legal_actions(current_state)
            for i in range(len(legal_actions)):
                action = legal_actions[i]
                new_actions = actions.copy()
                new_actions.append(action)
                new_state = self.apply_action(current_state, action)
                queue.append((new_state, new_actions))


class BestFirst(Algorithm):
    def __init__(self, heuristic=None):
        super().__init__(heuristic)

    def get_steps(self, initial_state, goal_state):
        queue = deque([(initial_state, [], 0)])
        visited = {}
        while queue:
            current_state, actions, heuristics_value = queue.popleft()

            if current_state in visited and heuristics_value >= visited[current_state]:
                continue
            visited[current_state] = heuristics_value

            if current_state == goal_state:
                return actions

            legal_actions = self.get_legal_actions(current_state)
            for i in range(len(legal_actions)):
                action = legal_actions[i]
                new_actions = actions.copy()
                new_actions.append(action)
                new_state = self.apply_action(current_state, action)
                new_heuristics = self.heuristic.get_evaluation(new_state)
                queue.append((new_state, new_actions, new_heuristics))
            queue = deque(sorted(queue, key=lambda x: (x[2], x[0])))


class AStar(Algorithm):
    def __init__(self, heuristic=None):
        super().__init__(heuristic)

    def get_steps(self, initial_state, goal_state):
        queue = deque([(initial_state, [], 0)])
        visited = {}
        while queue:
            current_state, actions, heuristics_value = queue.popleft()

            if current_state in visited and heuristics_value >= visited[current_state]:
                continue
            visited[current_state] = heuristics_value

            if current_state == goal_state:
                return actions

            legal_actions = self.get_legal_actions(current_state)
            for i in range(len(legal_actions)):
                action = legal_actions[i]
                new_actions = actions.copy()
                new_actions.append(action)
                new_state = self.apply_action(current_state, action)
                new_heuristics = self.heuristic.get_evaluation(new_state) + len(new_actions)
                queue.append((new_state, new_actions, new_heuristics))
            queue = deque(sorted(queue, key=lambda x: (x[2], x[0])))
