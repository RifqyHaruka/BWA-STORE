     

A = {'q0':{'a':'q1'},'q1':{'b':'q0'}}

def soal(x):
    try:
        mulai='q0'
        diterima='q0'
        status=mulai
        for c in x:
            status = A[status][c]
        if status in diterima:
            return "string diterima"
        else:
            return "string ditolak"
    except:
        return "tolak"

x = input("masukkan string:")
print(soal(x))