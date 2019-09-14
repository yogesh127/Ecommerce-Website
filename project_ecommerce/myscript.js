function f1(form)
{

var pass=document.getElementById("password").value;

var name=document.getElementById("name").value;
var mobile=document.getElementById("contact").value;
var address=document.getElementById("address").value;

var passlen=pass.length;
var namelen=name.length;
var mobilelen=contact.length;
var addresslen=address.length;
var namecount=0,mobilecount=0,addresscount=0,valid=0;

for(var i=0;i<namelen;i++)
	{
		if((name.charAt(i)>='a' && name.charAt(i)<='z')|| (name.charAt(i)>='A' && name.charAt(i)<='Z')||( name.charAt(i)==' '))
		{
			namecount++;		
		}
		else
			break;
	}
if(namecount==namelen)
{
	valid++;
}
else
{
	alert("name invalid");
	window.open("customer_register.php",'_self');
}
for(var i=0;i<mobilelen;i++)
	{
		if(mobile.charAt(i)>='0' && mobile.charAt(i)<='9')
		{
			mobilecount++;		
		}
		else
			break;
	}
if(mobilecount==mobilelen &&  mobilelen==10)
{
	valid++;
}
else
{
	alert("mobile invalid");
}
if(addresslen>=20)
{
	valid++;
}
else
{
	alert("address length must be 20");
}
if(passlen>=6 && passlen<=8)
{
	var num=0,lower=0,upper=0;
	for(var i=0;i<passlen;i++)
	{
		if(pass.charAt(i)>='0' && pass.charAt(i)<='9')
			num++;
		if(pass.charAt(i)>='a' && pass.charAt(i)<='z')
			lower++;
		if(pass.charAt(i)>='A' && pass.charAt(i)<='Z')
			upper++;
	}
	if(num>0 && lower>0 && upper>0)
	valid++;
	else
	alert("password not correct");
}
else
alert("password must be between 6 to 8");

if(valid==4)
{
alert("password 6 to 8");
form.submit();

}
}

