import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreateFlowchartComponent } from './create-flowchart.component';

describe('CreateFlowchartComponent', () => {
  let component: CreateFlowchartComponent;
  let fixture: ComponentFixture<CreateFlowchartComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CreateFlowchartComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CreateFlowchartComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
