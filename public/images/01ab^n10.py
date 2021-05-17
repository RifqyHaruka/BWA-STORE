string=  {'q0':{'0':'q1'},'q1':{'1':'q2'},'q2':{'a':'q3'},'q3':{'b':'q4'}
        ,'q4':{'a':'q3', '1':'q5'},'q5':{'0':'q6'}}

        

def mulai(x):
    try:
        mulai='q0'
        diterima='q6'
        status=mulai
        for c in x:
            status = string[status][c]
        if status in diterima:
            return "String diterima"
        else:
            return "String ditolak"
    except:
        return "String ditolak"

x = input("masukkan string:")
print(mulai(x))