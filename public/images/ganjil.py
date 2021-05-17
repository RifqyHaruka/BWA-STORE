ganjil = {'q0':{'0':'q0', '2':'q0' , '4':'q0', '6':'q0' ,'8':'q0', '1':'q1' ,'3':'q1', '5':'q1' ,'7':'q1', '9':'q1' },
       'q1':{'0':'q0', '2':'q0' , '4':'q0', '6':'q0' ,'8':'q0', '1':'q1' ,'3':'q1', '5':'q1' ,'7':'q1', '9':'q1'}}
	
       
def soal(x):
	try:
		mulai='q0'
		diterima='q1'
		status=mulai
		for c in x:
    			status = ganjil[status][c]
		if status in diterima:
    			return "string diterima"
		else:
    			return "string ditolak"
	except:
		return "string ditolak"

x = input("masukkan bilangan ganjil:")
print(soal(x))