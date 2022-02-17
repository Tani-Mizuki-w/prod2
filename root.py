import sys
import random
import math
import copy

import io,sys
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
import sys
args = sys.argv
#print(args)
#POINTS_SIZE = 5
POINTS_SIZE = int((len(args) - 1 ) / 3)
#print(POINTS_SIZE)
#POPULATION_SIZE = 10 # 集団の個体数
POPULATION_SIZE = int((len(args) -1) * 2 / 3)
#print(POPULATION_SIZE)
GENERATION = 100 # 世代数
MUTATE = 0.1  # 突然変異の確率
SELECT_RATE = 0.5 # 選択割合
# 経路(個体)の距離(適応度)を計算する


def calc_distance(points, route):
  distance = 0
  for i in range(POINTS_SIZE):
    (x0, y0) = points[route[i]]
    if i == POINTS_SIZE - 1:
  # 最後は始点へ戻る
      (x1, y1) = points[route[0]]
    else:
      (x1, y1) = points[route[i+1]]
  # 2点間の距離を求める公式
      distance = distance + math.sqrt((x0 - x1) * (x0 - x1) + (y0 - y1) * (y0 - y1))
  return distance

# 集団を距離(適応度)で昇順にソートする
def sort_fitness(points, population):
# 適応度と個体をタプルにしてリストへ格納する
  fp = []
  for individual in population:
    fitness = calc_distance(points, individual)
    fp.append((fitness, individual))
  fp.sort() # 適用度でソート(昇順)

  # ソートした個体を格納する集団
  sorted_population = []
# 個体を取り出し、集団に格納する
  for fitness, individual in fp:
    sorted_population.append(individual)
  return sorted_population

# 選択(適応度の高い(距離が短い)個体を残す)
def selection(points, population):
  sorted_population =  sort_fitness(points, population)
  # 残す個体数
  n = int(POPULATION_SIZE * SELECT_RATE)
  return sorted_population[0:n]

# 交叉(交叉点の範囲(r1~r2)は乱数で決める)
def crossover(ind1, ind2):
  r1 = random.randint(0, POINTS_SIZE - 1)
  r2 = random.randint(r1 + 1, POINTS_SIZE)
  # 使った都市のフラグのリストを0で初期化
  flag = [0] * POINTS_SIZE
  # 子の個体(-1で初期化)
  ind = [-1] * POINTS_SIZE
  # r1~r2をind2から複製
  for i in range(r1, r2):
    city = ind2[i]
    ind[i] = city
    # 使った都市のフラグに1をセット
    flag[city] = 1

  # r1~r2以外をind1から複製 (ただし、まだ使われていない都市のみ)
  for i in list(range(0, r1)) +  list(range(r2, POINTS_SIZE)):
    city = ind1[i]
    # その都市が使われていない場合
    if flag[city] == 0:
      ind[i] = city
      # 使った都市のフラグに1をセット
      flag[city] = 1

    # 残った都市
  for i in range(0, POINTS_SIZE):
    if ind[i] == -1: # 残った都市
    # 使われていない都市を探す
      for j in range(0, POINTS_SIZE):
        city = ind1[j]
        if flag[city] == 0:
          ind[i] = city
          # 使った都市のフラグに1をセット
          flag[city] = 1
          break
  return ind

# 突然変異
# 個体の各遺伝子に対して突然変異確率(MUTATE)に従って突然変異させる # ランダムに選んだ都市1と都市2の間を逆順にする
def mutation(ind1):
  ind2 = copy.deepcopy(ind1)
  if random.random() < MUTATE:
    # 都市1
    city1 = random.randint(0, POINTS_SIZE - 1) # 都市2
    city2 = random.randint(0, POINTS_SIZE - 1)
    if city1 > city2:
     city1, city2 = city2, city1 # 入れ替え
    # city1~city2の間を逆順にする
    ind2[city1:city2+1] = reversed(ind1[city1:city2+1])
  return ind2

# main
# 都市の座標を生成 (XとY:0~1.0の範囲でランダムに配置)
points = [] # 都市のリスト
for i in range(int(POINTS_SIZE)):
    x = 3 * i + 1
    y = 3 * i + 2
    ll = (float(args[x]),float(args[y]))
    points.append(ll)
#print(points)
# 初期集団を生成(各都市を一巡する経路の集団)
population = [] # 集団
for i in range(POPULATION_SIZE):
  # 個体(経路)
  individual = list(range(POINTS_SIZE)) # 経路をランダムに入れ替える
  random.shuffle(individual)
  population.append(individual)
for generation in range(GENERATION):
  #print(u"TSP by GA (" + str(generation + 1) + u"generation)")

  # 選択
  population = selection(points, population)
  # 交叉と突然変異
  # 交叉して増やす個体数
  n = POPULATION_SIZE - len(population)
  for i in range(n):
    # 集団から2個体をランダムに選び、
    # 交叉した個体を生成する
    r1 = random.randint(0, len(population) - 1)
    r2 = random.randint(0, len(population) - 1)
    individual = crossover(population[r1], population[r2])
    # 突然変異させる
    individual = mutation(individual)
    # 集団に追加する
    population.append(individual)

# 集団を適応度順にソートする
sort_fitness(points, population)
# 都市の経路を描画
for ind in range(POPULATION_SIZE):
  #canvas = canvas_list[ind]
  route = population[ind] # 経路
  dist = calc_distance(points, route)
  #print(route, dist)
  #canvas.delete('all') # キャンバスをクリア
  for i in range(POINTS_SIZE):
    (x0, y0) = points[route[i]]
    if i == POINTS_SIZE - 1:
# 最後は始点へ戻る
      (x1, y1) = points[route[0]]
    else:
      (x1, y1) = points[route[i+1]]
#round(a, 1)
#print("最短ルートは、" + str(route))

rooot = []
for i in range(POINTS_SIZE):
    po = route[i]
    poti = po * 3 + 3
    rooot.append(args[poti])

#print(route)
#print("ここまでシステムの確認用")
print(args)
print("最短ルートは、")
print(rooot)
#print("最短ルートは、",end='')
#print(str(rooot),end='')
#print("の順番です")
print("最短距離は、" + str(round(dist,4)) + "kmです")


#print("*注意：この結果は必ずしも正確ではありません。何度か実行してみてください。")

#print(route, dist)
