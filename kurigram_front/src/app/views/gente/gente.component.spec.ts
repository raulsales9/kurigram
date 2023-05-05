import { ComponentFixture, TestBed } from '@angular/core/testing';

import { GenteComponent } from './gente.component';

describe('GenteComponent', () => {
  let component: GenteComponent;
  let fixture: ComponentFixture<GenteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ GenteComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(GenteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
