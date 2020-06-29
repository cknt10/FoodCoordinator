export class Gift{
    private id: number;
    private reedemDay: Date;
    private startDay: Date;
    private endDay: Date;
    private isRedeem: boolean;

    getId(): number{
        return this.id;
    }

    getReedemDay(): Date{
        return this.reedemDay;
    }

    getStartDay(): Date{
        return this.startDay;
    }

    getEndDay(): Date{
        return this.endDay;
    }

    getIsRedeem(): boolean{
        return this.isRedeem;
    }

    setId(id: number){
        this.id = id;
    }


    setReedemDay(reedemDay: Date){
        this.reedemDay = reedemDay;
    }

    setStartDay(startDay: Date) {
        this.startDay = startDay;
    }

    setEndDay(endDay: Date){
        this.endDay = endDay;
    }

    setIsRedeem(isRedeem: boolean){
        this.isRedeem = isRedeem;
    }
}