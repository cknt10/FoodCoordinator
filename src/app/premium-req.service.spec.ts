import { TestBed } from '@angular/core/testing';

import { PremiumReqService } from './premium-req.service';

describe('PremiumReqService', () => {
  let service: PremiumReqService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PremiumReqService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
