genap = {'q0':{'1':'q0', '3':'q0' , '5':'q0', '7':'q0' ,'9':'q0', '2':'q1' ,'4':'q1', '6':'q1' ,'8':'q1' },
       'q1':{'1':'q0', '3':'q0' , '5':'q0', '7':'q0' ,'9':'q0', '0':'q1' ,'2':'q1', '4':'q1' ,'6':'q1', '8':'q1'}}
	
       
def soal(x):
	try:
		mulai='q0'
		diterima='q1'
		status=mulai
		for c in x:
    			status = genap[status][c]
		if status in diterima:
    			return "string diterima"
		else:
    			return "string ditolak"
	except:
		return "string ditolak"

x = input("masukkan bilangan genap:")
print(soal(x))