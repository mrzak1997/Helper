export class Flowchart_nodes {
    node_id!:number;
    node_previous! : number;
    node_next! : number;
    node_text! : string;
    node_type!: Node_type;
}
  interface Node_type{
    value: string;
    viewValue: string;
  }
 