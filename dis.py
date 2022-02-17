from geopy.distance import geodesic
from var import Var
from db import DB
import io,sys
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

#スポット名を抽出
query = "SELECT spot_name FROM Kyoto_spot"
data = ()
db = DB(Var.hostname, Var.port, Var.dbname, Var.username, Var.password)
spot_name = db.execute(query, data)
print(spot_name)

"""
#緯度・経度を抽出
query2 = "SELECT spot_latitude,spot_longitude FROM Kyoto_spot "
data = ()
db = DB(Var.hostname, Var.port, Var.dbname, Var.username, Var.password)
ll = db.execute(query2, data)

#dis = geodesic((ll[0][0],ll[0][1]),(ll[1][0],ll[1][1]))
speed = 4

for i in range(len(ll)-1):
    dis = geodesic((ll[0][0],ll[0][1]),(ll[i+1][0],ll[i+1][1])).km
    time = dis / 4
    print(str(spot_name[0]) + "と" + str(spot_name[i+1]) + "の距離は"  + str(dis) + "km")
    print(str(spot_name[0]) + "と" + str(spot_name[i+1]) + "の移動時間は"  + str(time) + "h")
"""
