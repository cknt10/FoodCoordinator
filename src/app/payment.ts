export class Payment {
  private id: number;
  private description: string;
  private isPayed: boolean;

  constructor(payment: Payment){
      this.id = payment.id;
      this.description = payment.description;
      this.isPayed = this.isPayed;
  }

  getId(): number{
      return this.id;
  }

  getDescription(): string{
      return this.description;
  }

  getIsPayed(): boolean{
      return this.isPayed;
  }

  setIsPayed(payed: boolean){
      this.isPayed = payed;
  }
}
