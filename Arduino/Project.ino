#include <Wire.h>
#include <Adafruit_BMP085.h>
#include <SimpleDHT.h>

Adafruit_BMP085 bmp;
SimpleDHT11 dht11;
const int pinDHT11 = 2;

float temperatura = 0.0;
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
}

void loop() 
{ 
  temperatura = bmp.readTemperature();
  cisnienie = bmp.readPressure();
  wysokosc = bmp.readAltitude();
  opady = analogRead(A0);
  dht11.read(pinDHT11, &temperature, &humidity, NULL);

  wilgotnosc = (int)humidity;
  temperatura = temperatura + (float)temperature;
  temperatura = temperatura / 2.0;

  json="{\"temp\" : \""+String(temperatura)+"\",\"press\":\""+String(cisnienie)+"\",\"altit\":\""+String(wysokosc)+"\",\"rain\":\""+String(opady)+"\",\"humidi\":\""+String(wilgotnosc)+"\"}";
  Serial.println(json);
  delay(1000);
}
