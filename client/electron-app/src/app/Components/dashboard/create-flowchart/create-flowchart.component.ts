import { FormControl, FormGroup } from '@angular/forms';
import { Flowchart_nodes } from './../../shared/models/flowchart_nodes';
import { Component, OnInit } from '@angular/core';
import { FormBuilder,Validators,FormArray  } from '@angular/forms';
import { AlertService } from '../../shared/alert/alert.service';
import { flowchartFieldModel } from '../../shared/models/add-flowchart-form-model';
interface gender {
  value: string;
  viewValue: string;
}
@Component({
  selector: 'app-create-flowchart',
  templateUrl: './create-flowchart.component.html',
  styleUrls: ['./create-flowchart.component.scss']
})
export class CreateFlowchartComponent implements OnInit {
  survey?: FormGroup;
  flowchart!: Flowchart_nodes[];
  flowchartFromFields! : flowchartFieldModel[];
  flowchartForm = this.fb.group({
    title : ['', Validators.required],
    nodes: this.fb.array([


    ])

  })
  genders: gender[] = [
    {value: '1', viewValue: 'زن'},
    {value: '2', viewValue: 'مرد'},
    {value: '3', viewValue: 'نمیگم'},
  ];
  types: gender[] = [
    {value: '1', viewValue: 'شروع'},
    {value: '2', viewValue: 'شرط'},
    {value: '3', viewValue: 'دستور'},
  ];
  node_list: gender[] = [
    {value: '1', viewValue: 'شروع'},
    {value: '2', viewValue: 'شرط'},
    {value: '3', viewValue: 'دستور'},
  ];
  constructor(private fb: FormBuilder,private alertService: AlertService,) { }
  initSection() {
    return new FormGroup({
      sectionTitle: new FormControl(''),
      sectionDescription: new FormControl(''),

    });
  }
  ngOnInit(): void {

    this.survey = new FormGroup({
      surveyName: new FormControl(''),

      sections: new FormArray([
        this.initSection(),
      ]),
    });
    this.flowchart = [
      {
        node_id : 1,
        node_next : 2,
        node_previous: 0,
        node_text : "نود اول",
        node_type : {value : "1" , viewValue : 'شروع'}
      },
      {
        node_id : 2,
        node_next : 0,
        node_previous: 1,
        node_text : "نود دوم",
        node_type : {value : "2" , viewValue : 'شرط'}
      },
    ]
    this.flowchartFromFields = [
      {
        id:1,
        type: "text",
        label : 'متن'
      },
      {
        id:2,
        type: "select",
        label : 'مرحله قبلی'
      },
      {
        id:3,
        type: "select",
        label : 'مرحله بعدی'
      },
      {
        id:4,
        type: "select",
        label : 'توع'
      },
    ]
    this.nodes.push(
      this.createFG()

    );
    console.log('this.nodes')
    console.log(this.nodes)
  }
  createFG(){
    let id = this.nodes.length
    return  new FormGroup({
      node_id : this.fb.control(id),
      node_next : this.fb.control(''),
      node_previous: this.fb.control(''),
      node_text : this.fb.control(''),
      node_type: this.fb.control('')
    })
  }
  get nodes() {
    return this.flowchartForm.get('nodes') as FormArray;
  }
  addNodes() {
    console.log(this.nodes)
    this.nodes.push(this.createFG())
  }
}
