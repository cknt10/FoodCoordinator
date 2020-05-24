import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { VorteileComponent } from './vorteile.component';

describe('VorteileComponent', () => {
  let component: VorteileComponent;
  let fixture: ComponentFixture<VorteileComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ VorteileComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(VorteileComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
