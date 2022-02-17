
import io,sys
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
import sys
args = sys.argv
print(args)

c = len(args)-1
d = (len(args) - 1 ) / 2
print(c)
print(int(d))
#print("緯度は：" + args[1])
#print("経度は：" + args[2])
for i in range(c):
    j = i + 1
    print(j)
    print(args[j])

points = [] # 都市のリスト
for k in range(int(d)):
    x = (k * 2 )+ 1
    y = x + 1
    #print(args[x])
    #print(args[y])
    ll = (args[x],args[y])
    #print(ll)
    points.append(ll)
    #points.append((b[i], b[i]))
print(points)
