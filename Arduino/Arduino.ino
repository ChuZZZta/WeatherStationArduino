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

// t - temperatura, c - cisnienie, w - wilgotnosc, o - opady, wys - wysokosc
int t = 0;
float c = 0.0;
int w = 0;
int o = 0;
float wys = 0.0;

byte temperature = 0;
byte humidity = 0;
String json = "";

void setup() 
{
  bmp.begin();
  if (ether.begin(sizeof Ethernet::buffer, mymac) == 0)
    Serial.println(F("Niepoprawnie podlaczony ethernet shield."));
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
      t,(int)c,(int)wys,o,w);
  return bfill.position();
}

void loop() 
{ 
  t = bmp.readTemperature();
  c = bmp.readPressure()/100;
  wys = bmp.readAltitude();
  o = analogRead(A3);
  dht11.read(pinDHT11, &temperature, &humidity, NULL);

  w = (int)humidity;
  t = t + (int)temperature;
  t = t / 2;

  word len = ether.packetReceive();
  word pos = ether.packetLoop(len);
  
  if (pos) ether.httpServerReply(homePage()); 
}
