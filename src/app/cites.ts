export class Cities {
  private cityId: number;
  private city: string;
  private postcode: number;

  constructor(cities: Cities) {
    this.cityId = cities.cityId;
    this.city = cities.city;
    this.postcode = cities.postcode;
  }

  getCityId(): number {
    return this.cityId;
  }

  getCity(): string {
    return this.city;
  }

  getPostCode(): number {
    return this.postcode;
  }

  setCityId(id: number) {
    this.cityId = id;
  }

  setCity(city: string) {
    this.city = city;
  }

  setPostCode(postcode: number) {
    this.postcode = postcode;
  }
}
