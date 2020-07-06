export class PremiumModel{
    public id: number;
    public description: string;
    public duration: number;
    public netprice: number;
    public startDay: Date;

    constructor(premium: PremiumModel){
        this.id = premium.id;
        this.description = premium.description;
        this.duration = premium.duration;
        this.netprice = premium.netprice;
        this.startDay = premium.startDay;
    }

    getId(): number{
        return this.id;
    }

    getDescription(): string{
        return this.description;
    }

    getDuration(): number{
        return this.duration;
    }

    geNetPrice(): number{
        return this.netprice;
    }

    getStartDay(): Date{
        return this.startDay;
    }

    setStartDay(start: Date){
        this.startDay = start;
    }
}
