import { RoomType } from "./room";
import { StatusType } from "./status";

export interface ComputerType {
    computer_id: string;
    name: string;
    description: string;
    room_id: string;
    status_id: number;
    created_at: string;
    updated_at: string;
    room?: RoomType;
    status?: StatusType;
}
