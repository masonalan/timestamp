def writeToFile(array):
	f = open('points', 'w')
	f.write(array[0] + '\n' + array[1] + '\n')
	f.close()
def getPoint():
	x = raw_input("X Coordinate: ")
	y = raw_input("Y Coordinate: ")
	write = [x,y]
	writeToFile(write)

def main():
	while 1:
		getPoint()