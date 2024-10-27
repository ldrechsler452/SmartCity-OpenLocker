import { TLockerItem } from '@/types';
import { Link } from '@inertiajs/react';
import React from 'react';

interface LockerItemProps {
    lockerItem: TLockerItem;
}

const LockerItem: React.FC<LockerItemProps> = ({ lockerItem }) => {
    return (
        <div className="w-100 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div className="text-gray-900 dark:text-gray-100">
                <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{lockerItem.name}</h5>
            </div>
        </div>
    );
};

export default LockerItem;
