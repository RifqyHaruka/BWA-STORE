mhs= {'q0':{'A':'q1','N':'q10','B':'q5','M':'q45','Z':'q62','K':'q48','L':'q12','F':'q16','V':'q53','D':'q37','Y':'q57','R':'q26','S':'q34'},
        'q1':{'R':'q2'},'q2':{'D':'q3'},'q3':{'I':'q4'}, #Ardi
        'q10':{'C':'q11'},'q11':{'I':'q4'}, #NCI
        'q5':{'I':'q6'},'q6':{'L':'q7'},'q7':{'A':'q8','I':'q4'},'q8':{'L':'q9'}, #BILAL,#BILI
        'q45':{'A':'q46'},'q46':{'U':'q47'},'q47':{'L':'q9'}, #MAUl
        'q62':{'I':'q63'},'q63':{'D':'q64'},'q64':{"A":'q65'},"q65":{"N":'q66'}, #ZIDAN
        'q48':{'A':'q49'},'q49':{'L':'q50'},'q50':{"I":'q51'},'q51':{'P':'q52'}, #KALIP
        'q12':{'U':'q13'},'q13':{'T':'q14'},'q14':{'F':'q15'},'q15':{'I':'q4'}, #LUTFI
        'q16':{'A':'q17'},'q17':{'T':'q18','R':'q23'},'q18':{'O':'q19','A':'q21'},'q19':{'N':'q20'},'q20':{'I':'q4'}, #FATONI
        'q23':{'E':'q24'},'q24':{'L':'q25'}, #FAREL
        'q21':{'H':'q22'}, #FATAH
        'q53':{'I':'q54'},'q54':{'K':'q55'},'q55':{'A':'q56'}, #VIKA
        'q37':{'A':'q38','I':'q42'},'q38':{'T':'q39'},'q39':{'U':'q40'},'q40':{'L':'q41'}, #DATUL
        'q42':{'D':'q43'},'q43':{'I':'q44'}, #DIDI
        'q57':{'A':'q58'},'q58':{'Z':'q59'},'q59':{'I':'q60'},'q60':{'D':'q61'},#YAZID
        'q26':{'I':'q27','A':'q33','E':'q67'},'q27':{'F':'q28','Z':'q31','S':'q32'},'q28':{'Q':'q29'},'q29':{'Y':'q30'},#RIFQY,#RIS,#RIZ
        'q33':{'Y':'q30'},#RAY
        'q67':{'K':'q68'},#REK
        'q34':{'I':'q35'},'q35':{'S':'q36'},'q36':{'Y':'q30'} #SISY
        }

def mulai(x):
    try:
        mulai='q0'
        diterima=['q4','q7','q9','q66','q52','q26','q25','q22','q56','q41','q44','q61','q30','q31','q32','q68']
        status=mulai
        for c in x:
            status = mhs[status][c]
        if status in diterima:
            return "String diterima"
        else:
            return "String ditolak"
    except:
        return "String ditolak"

x = input("masukkan nama:")
print(mulai(x))