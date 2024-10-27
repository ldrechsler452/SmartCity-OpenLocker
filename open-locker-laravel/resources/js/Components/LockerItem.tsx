import { TLockerItem } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import React from 'react';

interface LockerItemProps {
    lockerItem: TLockerItem;
}

const LockerItem: React.FC<LockerItemProps> = ({ lockerItem }) => {
    const user = usePage().props.auth.user;
    return (
        <div className="w-100 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div className="text-gray-900 dark:text-gray-100">
                <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{lockerItem.name}</h5>
                {lockerItem.image&&<div className="w-2/5">
                    <img src={route('content.image', lockerItem.id)}
                         alt={`${lockerItem.name} image`}
                         className="object-cover h-full w-full"/>
                </div>}
                {lockerItem.user_id == user.id && <p>Ausgeliehen</p>}
            </div>
        </div>
    );
};

export default LockerItem;
