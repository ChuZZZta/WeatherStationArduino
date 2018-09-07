function onLoad()
{
	clock();
	updateView(odczyt);
}

function clock()
{
	var date = new Date();
	document.getElementById("clock").innerHTML = date.getDate()+"."+date.getMonth()+"."+date.getFullYear()+" | "+date.getHours()+":"+date.getMinutes();
}

function updateView(odczyt)
{
	var temp = ["#0000FF","#0023FF","#0046FF","#0069FF","#008CFF","#00AFFF","#00D3FF","#00F6FF","#00FFE4","#00FFC1","#9EFF00","#C1FF00","#E4FF00","#FFF600","#FFD300","#FFAF00","#FF8C00","#FF6900","#FF4600","#FF2300"]
	document.getElementById("temp").innerHTML = odczyt[0]+"*C";
	document.getElementById("temp").style.backgroundColor = temp[Math.floor(odczyt[0]/3)+7];
	
	var humi = ["#A3CAFF","#9AC2F9","#91BAF4","#89B3EE","#80ABE9","#78A4E4","#6F9CDE","#6695D9","#5E8DD4","#5586CE","#4D7EC9","#4477C3","#3C8FBE","#3368B9","#2A60B3","#2259AE","#1951A9","#114AA3","#08429E","#003B99"]
	document.getElementById("humi").innerHTML = odczyt[1]+"%";
	document.getElementById("humi").style.backgroundColor = humi[Math.floor(odczyt[1]/5)];
	
	var press = ["#FFFB29","#F4FB33","#E9FB3D","#DEFB48","#D3FB52","#C8FC5D","#BDFC67","#B2FC71","#A7FC7C","#9CFC86","#91FD91","#86FD9B","#7BFDA6","#70FDB0","#65FDBA","#5AFEC5","#4FFECF","#44FEDA","#39FEE4","#2EFFEF"]
	document.getElementById("press").innerHTML = odczyt[2]+"hpa";
	document.getElementById("press").style.backgroundColor = press[Math.floor(odczyt[2]-980)];
	
	if(odczyt[3]>700)
	{
		document.getElementById("rain").style.backgroundColor = "#ffc700"; 
		document.getElementById("rain").innerHTML = "Sucho";
	}else if(odczyt[3]>500)
	{
		document.getElementById("rain").style.backgroundColor = "#8be5ef"; 
		document.getElementById("rain").innerHTML = "Wilgotno";
	}else{
		document.getElementById("rain").style.backgroundColor = "#238dff"; 
		document.getElementById("rain").innerHTML = "Pada";
	}
}