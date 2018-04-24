#include <Wire.h>
#include <Adafruit_BMP085.h>
#include <SimpleDHT.h>
#include <EtherCard.h>

Adafruit_BMP085 bmp;
SimpleDHT11 dht11;
const int pinDHT11 = 2;

static byte mymac[] = { 0x74,0x69,0x69,0x2D,0x30,0x31 };
static byte myip[] = { 192,168,0,200 };
byte Ethernet::buffer[500];
BufferFiller bfill;

int temperatura = 0;
float cisnienie = 0.0;
int wilgotnosc = 0;
int opady = 0;
float wysokosc = 0.0;

byte temperature = 0;
byte humidity = 0;
String json = "";

void setup() 
{
  Serial.begin(9600);
  bmp.begin();
  if (ether.begin(sizeof Ethernet::buffer, mymac) == 0)
    Serial.println(F("Failed to access Ethernet controller"));
  ether.staticSetup(myip);
}

static word homePage() {
  bfill = ether.tcpOffset();
  bfill.emit_p(PSTR(
    "HTTP/1.0 200 OK\r\n"
    "Content-Type: text/html\r\n"
    "Pragma: no-cache\r\n"
    "\r\n"
    "{\"temp\" : \"$D\",\"press\":\"$D\",\"altit\":\"$D\",\"rain\":\"$D\",\"humidi\":\"$D\"}"),
      temperatura,(int)cisnienie,(int)wysokosc,opady,wilgotnosc);
  return bfill.position();
}

void loop() 
{ 
  temperatura = bmp.readTemperature();
  cisnienie = bmp.readPressure()/100;
  wysokosc = bmp.readAltitude();
  opady = analogRead(A3);
  dht11.read(pinDHT11, &temperature, &humidity, NULL);

  wilgotnosc = (int)humidity;
  temperatura = temperatura + (int)temperature;
  temperatura = temperatura / 2;

  //json="{\"temp\" : \""+String(temperatura)+"\",\"press\":\""+String(cisnienie)+"\",\"altit\":\""+String(wysokosc)+"\",\"rain\":\""+String(opady)+"\",\"humidi\":\""+String(wilgotnosc)+"\"}";
  //Serial.println(json);
  //delay(1000);

  word len = ether.packetReceive();
  word pos = ether.packetLoop(len);
  
  if (pos)  // check if valid tcp data is received
    ether.httpServerReply(homePage()); // send web page data
  
}
